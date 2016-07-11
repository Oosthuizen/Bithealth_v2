<?php
//Prerequisites:
include_once __DIR__."/Log.php";

class HelperFunctions {
    //GENERAL FUNCTIONS
    /*
    This is only used in the header - Initiates/resumes the session and
    turns output buffering on for the site. Sets the timezone. Sets up the log
    if applicable and sets database parameters.
    */
    public static function startOrResumeSession($useLog) {
        //Start/resume session
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        //Turn on output buffering
        ob_start();

        //Set default timezone
        if (date_default_timezone_get()!=="Africa/Johannesburg") {
            date_default_timezone_set("Africa/Johannesburg");
        }

        //Include the necessary header fields and class for log type
        if ($useLog) {
            print '<link rel="stylesheet" type="text/css" href="style/logStyle.css" />';
            print '<script type="text/javascript" src="javascript/LogScript.js"></script>';
            //Set up the log if applicable
            if (!isset($_SESSION['log']) || empty($_SESSION['log'])) {
                $_SESSION['log'] = new Log("QNOT SITE LOG");
                $updateDateTime = date("Y-m-d H:i:s");
                self::log(0,"header.php", "Log initiated @ ".$updateDateTime.".");
            }
        } else {
            if (isset($_SESSION['log'])) {
                unset($_SESSION['log']);
            }
        }

        //Set the default database
        if (!self::$host || !self::$user || !self::$password || !self::$database) {
            self::setDatabaseParameters("localhost","root","","");
        }

        //import the relevant script for rendering elements based on the user type
        print '<script id="userScriptPlaceholder" type="text/javascript" src="'.self::userScriptPath().'"></script>';
    }

    public static function userScriptPath() {
        $userType = self::getUserType();
        switch ($userType) {
            case 1:
                return 'javascript/private/adminUser.js';
                break;
            case 2:
                return 'javascript/private/customerUser.js';
                break;
            case 3:
                return 'javascript/private/vendorUser.js';
                break;
            default:
                return 'javascript/private/unregisteredUser.js';
                break;
        }
    }

    public static function simpleSessionResume() {
        //Start/resume session
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        //Turn on output buffering
        ob_start();
        //Set default timezone
        if (date_default_timezone_get()!=="Africa/Johannesburg") {
            date_default_timezone_set("Africa/Johannesburg");
        }
        //Set the default database
        if (!self::$host || !self::$user || !self::$password || !self::$database) {
            self::setDatabaseParameters("localhost","root","","");
        }
    }

    /*
    If the current session has a log, add a message of $type to the log with
    $source as the source of the message and $msg as the contents.
    $type = -1 is an error message.
    */
    public static function log($type, $source, $msg) {
        //Log if the log is set to be used
        if((isset($_SESSION['log']) && !empty($_SESSION['log'])) && is_numeric($type) && is_string($source) && is_string($msg)) {
            $_SESSION['log']->addToLog($type,$source,$msg);
        }
    }

    /*
    Redirects the browser to $pageLocation.
    */
    public static function redirectResponse($pageLocation) {
        self::log(0,"HelperFunctions::redirectResponse()","Redirecting to ".$pageLocation.".");
        if (is_string($pageLocation)) {
            header("Location: " . $pageLocation);
            exit;
        }
    }

    //USER MANAGEMENT
    /*
    Logs out any existing user and logs the specified user in, if applicaple
    and returns true if successful, false otherwise.
    */
    public static function login($username, $password) {
        self::log(0,"HelperFunctions::login()","Logging ".$username." in.");
        $userLoggedIn = false;
        //If a user is already logged in, log the user out
        self::logout();
        //If the username exists in the database
        if ($userDetails = self::retrieveData("SELECT `UserID`,`Username`,`UserType`,`Password`,`NumberLogins` FROM `USER` WHERE `Username` = ?", $username)) {
            //Verify the user's password
            if ($passwordVerified = password_verify($password, $userDetails[0]["Password"])) {
                //Set the relevant session variables
                $_SESSION['uname'] = $userDetails[0]['Username'];
                $_SESSION['utype'] = $userDetails[0]['UserType'];
                $_SESSION['uid'] = $userDetails[0]['UserID'];
                //Update update relevant database fields
                $cmd = "UPDATE `USER`";
                $cmd .= " SET `NumberLogins` = ?, `LastLogin` = ?";
                $cmd .= " WHERE `UserID` = ?;";
                $updateLogins = $userDetails[0]['NumberLogins'] + 1;
                $updateDateTime = date("Y-m-d H:i:s");
                self::modifyData($cmd, $updateLogins, $updateDateTime, $userDetails[0]['UserID']);
                $userLoggedIn = true;
            } else {
                self::log(-1,"HelperFunctions::login()","Invalid password.");
            }
        } else {
            self::log(-1,"HelperFunctions::login()","Invalid username.");
        }
        return $userLoggedIn;
    }

    /*
    Log any currently logged in user out.
    */
    public static function logout() {
        //User is logged in
        if(isset($_SESSION['uname']) && !empty($_SESSION['uname'])) {
            //Add to log with data and time if applicabple
            if (isset($_SESSION['log']) && !empty($_SESSION['log'])) {
                $updateDateTime = date("Y-m-d H:i:s");
                self::log(0,"HelperFunctions::logout()",$_SESSION['uname']." logged out @ ".$updateDateTime.". Ending session.");
                //Save the log logs/server.log
                $_SESSION['log']->saveToFile();
            }
            //Unset the session variables
            $_SESSION = array();
            //Destroy the session cookie (see http://php.net/manual/en/function.session-destroy.php)
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            //Destroy the session data
            session_destroy();
        }
    }

    /*
    Verifies whether the current user is of the specified type for
    authentication purposes.
    */
    public static function isUserType($userType) {
        self::log(0,"HelperFunctions::isUserType()", "Checking user type.");
        if(gettype($userType) == "integer") {
            return $userType == self::getUserType();
        } else {
            return false;
        }
    }

    /*
    Retrieve the current session's user type, -1 if not logged in.
    */
    public static function getUserType() {
        self::log(0,"HelperFunctions::getUserType()", "Fetching session user type.");
        if(isset($_SESSION['utype'])) {
            return $_SESSION['utype'];
        }
        return -1;
    }

    /*
    Retrieve the current session's username, "Unregistered" if not logged in.
    */
    public static function getUsername() {
        self::log(0,"HelperFunctions::getUsername()", "Fetching session username.");
        if(isset($_SESSION['uname'])) {
            return $_SESSION['uname'];
        }
        return "Unregistered";
    }

    /*
    Change the specified user's password. Returns true if successful, false
    otherwise.
    */
    public static function changePassword($userID, $oldPassword, $newPassword) {
        self::log(0,"HelperFunctions::changePassword()", "Changing user password.");
        $passwordChanged = false;
        if ((gettype($userID) == "integer") && is_string($oldPassword) && is_string($newPassword)) {
            //if the user exists
            if ($userDetails = self::retrieveData("SELECT `Password` FROM `USER` WHERE `UserID` = ?", $userID)) {
                //if the correct old password was provided
                if (password_verify($oldPassword, $userDetails[0]["Password"])) {
                    //update the password
                    $cmd = "UPDATE USER";
                    $cmd .= " SET Password = ?";
                    $cmd .= " WHERE UserID = ?;";
                    if (self::modifyData($cmd, password_hash($newPassword, PASSWORD_DEFAULT), $userID)) {
                        $passwordChanged = true;
                    } else {
                        self::log(-1,"HelperFunctions::changePassword()", "Could not change the password for UserID: ".$userID.".");
                    }
                } else {
                    self::log(-1,"HelperFunctions::changePassword()", "Did not change the password for UserID: ".$userID.". Incorrect old password.");
                }
            } else {
                self::log(-1,"HelperFunctions::changePassword()", "Could not retrieve user with UserID: ".$userID.".");
            }
        } else {
            self::log(-1,"HelperFunctions::changePassword()", "Invalid argument types.");
        }
        return $passwordChanged;
    }

    /*
    Adds user of type $userType with attributes $userAttributes. Returns true
    if both user and subtype were successfully added.
    */
    public static function addUser($userType, ...$userAttributes) {
        //Assume failure
        $userAdded = false;
        if (gettype($userType) == "integer") {
            //If recognises attribute types were passed
            if($attributeTypes = self::parameterString(...$userAttributes)) {
                $cmd = "INSERT INTO USER (Username, Title, FirstName, LastName, Email, ContactNumber, UserType, Password)";
                $cmd .= " VALUES(?,?,?,?,?,?,?,?);";
                switch ($userType) {
                    case 1:
                        if ($attributeTypes == "sssssssi") {
                            if($modified = self::modifyData($cmd, $userAttributes[0], $userAttributes[1], $userAttributes[2], $userAttributes[3], $userAttributes[4], $userAttributes[5], $userType, password_hash($userAttributes[6], PASSWORD_DEFAULT))) {
                                if (self::modifyData("UPDATE DB_TRACKER SET Version = Version + 1 WHERE Property = ?;","user")) {
                                    self::log(1,"HelperFunctions::addUser()","'user' version in database updated.");
                                } else {
                                    self::log(-1,"HelperFunctions::addUser()","Could not update database's 'user' version.");
                                }
                                $cmd = "INSERT INTO ADMINISTRATOR (AccessLevel,UserID)";
                                $cmd .= " VALUES(?,?);";
                                $lastID = $modified[1];
                                if (self::modifyData($cmd, $userAttributes[7], $lastID)) {
                                    if (self::modifyData("UPDATE DB_TRACKER SET Version = Version + 1 WHERE Property = ?;","admin")) {
                                       self::log(1,"HelperFunctions::addUser()","'admin' version in database updated.");
                                    } else {
                                        self::log(-1,"HelperFunctions::addUser()","Could not update database's 'admin' version.");
                                    }
                                    $userAdded = true;
                                } else {
                                    self::log(-1,"HelperFunctions::addUser()", "Could not add admin user subtype for UserID: ".$lastID.".");
                                }
                            } else {
                                self::log(-1,"HelperFunctions::addUser()", "Could not add user. Perhaps the username is already in use.");
                            }
                        } else {
                            self::log(-1,"HelperFunctions::addUser()", "Administrator attributes example: 'username','title','firstname','lastname','email','contactnumber','password',1(accesslevel)");
                        }
                        break;
                    case 2:
                        if ($attributeTypes == "sssssss") {
                            if($modified = self::modifyData($cmd, $userAttributes[0], $userAttributes[1], $userAttributes[2], $userAttributes[3], $userAttributes[4], $userAttributes[5], $userType, password_hash($userAttributes[6], PASSWORD_DEFAULT))) {
                                if (self::modifyData("UPDATE DB_TRACKER SET Version = Version + 1 WHERE Property = ?;","user")) {
                                    self::log(1,"HelperFunctions::addUser()","'user' version in database updated.");
                                } else {
                                    self::log(-1,"HelperFunctions::addUser()","Could not update database's 'user' version.");
                                }
                                $cmd = "INSERT INTO CUSTOMER (UserID)";
                                $cmd .= " VALUES(?);";
                                $lastID = $modified[1];
                                if (self::modifyData($cmd, $lastID)) {
                                    if (self::modifyData("UPDATE DB_TRACKER SET Version = Version + 1 WHERE Property = ?;","customer")) {
                                        self::log(1,"HelperFunctions::addUser()","'customer' version in database updated.");
                                    } else {
                                        self::log(-1,"HelperFunctions::addUser()","Could not update database's 'customer' version.");
                                    }
                                    $userAdded = true;
                                } else {
                                    self::log(-1,"HelperFunctions::addUser()", "Could not add customer user subtype for UserID: ".$lastID.".");
                                }
                            } else {
                                self::log(-1,"HelperFunctions::addUser()", "Could not add user. Perhaps the username is already in use.");
                            }
                        } else {
                            self::log(-1,"HelperFunctions::addUser()", "Customer attributes example: 'username','title','firstname','lastname','email','contactnumber','password'");
                        }
                        break;
                    case 3:
                        if ($attributeTypes == "sssssssssss") {
                            if($modified = self::modifyData($cmd, $userAttributes[0], $userAttributes[1], $userAttributes[2], $userAttributes[3], $userAttributes[4], $userAttributes[5], $userType, password_hash($userAttributes[6], PASSWORD_DEFAULT))) {
                                if (self::modifyData("UPDATE DB_TRACKER SET Version = Version + 1 WHERE Property = ?;","user")) {
                                    self::log(1,"HelperFunctions::addUser()","'user' version in database updated.");
                                } else {
                                    self::log(-1,"HelperFunctions::addUser()","Could not update database's 'user' version.");
                                }
                                $cmd = "INSERT INTO VENDOR (CompanyName,TradingAs,Address,VATNumber,UserID)";
                                $cmd .= " VALUES(?,?,?,?,?);";
                                $lastID = $modified[1];
                                if (self::modifyData($cmd, $userAttributes[7], $userAttributes[8], $userAttributes[9], $userAttributes[10], $lastID)) {
                                    if (self::modifyData("UPDATE DB_TRACKER SET Version = Version + 1 WHERE Property = ?;","vendor")) {
                                        self::log(1,"HelperFunctions::addUser()","'vendor' version in database updated.");
                                    } else {
                                        self::log(-1,"HelperFunctions::addUser()","Could not update database's 'vendor' version.");
                                    }
                                    $userAdded = true;
                                } else {
                                    self::log(-1,"HelperFunctions::addUser()", "Could not add vendor user subtype for UserID: ".$lastID.".");
                                }
                            } else {
                                self::log(-1,"HelperFunctions::addUser()", "Could not add user. Perhaps the username is already in use.");
                            }
                        } else {
                            self::log(-1,"HelperFunctions::addUser()", "Vendor attributes example: 'username','title','firstname','lastname','email','contactnumber','password','company ltd','trading as','address','4123412344'");
                        }
                        break;
                    default:
                        self::log(-1,"HelperFunctions::addUser()", "Unhandled user type: ".$userType);
                        break;
                }
            }
        } else {
            self::log(-1,"HelperFunctions::addUser()", "Expects integer type for \$userType.");
        }
        return $userAdded;
    }

    /*
    Deletes the specified user and its subtype. Returns true on successful
    deletion of user, false otherwise.
    */
    public static function deleteUser($userID) {
        self::log(0,"HelperFunctions::deleteUser()", "Deleting user with UserID: ".$userID);
        $userDeleted = false;
        if (gettype($userID) == "integer") {
            //If the user exists
            if($results = self::retrieveData("SELECT `UserType` FROM `USER` WHERE `UserID` = ?;", $userID)) {
                //Delete user subtype
                $userType = $results[0]['UserType'];
                switch ($userType) {
                    case 1:
                        if (self::modifyData("DELETE FROM `ADMINISTRATOR` WHERE `UserID`=?;", $userID)) {
                            if (self::modifyData("UPDATE DB_TRACKER SET Version = Version + 1 WHERE Property = ?;","admin")) {
                               self::log(1,"HelperFunctions::addUser()","'admin' version in database updated.");
                            } else {
                                self::log(-1,"HelperFunctions::addUser()","Could not update database's 'admin' version.");
                            }
                        }
                        break;
                    case 2:
                        if (self::modifyData("DELETE FROM `CUSTOMER` WHERE `UserID`=?;", $userID)) {
                            if (self::modifyData("UPDATE DB_TRACKER SET Version = Version + 1 WHERE Property = ?;","customer")) {
                                self::log(1,"HelperFunctions::addUser()","'customer' version in database updated.");
                            } else {
                                self::log(-1,"HelperFunctions::addUser()","Could not update database's 'customer' version.");
                            }
                        }
                        break;
                    case 3:
                        if (self::modifyData("DELETE FROM `VENDOR` WHERE `UserID`=?;", $userID)) {
                            if (self::modifyData("UPDATE DB_TRACKER SET Version = Version + 1 WHERE Property = ?;","vendor")) {
                                self::log(1,"HelperFunctions::addUser()","'vendor' version in database updated.");
                            } else {
                                self::log(-1,"HelperFunctions::addUser()","Could not update database's 'vendor' version.");
                            }
                        }
                        break;
                    default:
                        self::log(-1,"HelperFunctions::deleteUser()", "Unhandled user type: ".$userType);
                        break;
                }
                //Delete the user
                if (self::modifyData("DELETE FROM `USER` WHERE `UserID`=?;", $userID)) {
                    if (self::modifyData("UPDATE DB_TRACKER SET Version = Version + 1 WHERE Property = ?;","user")) {
                        self::log(1,"HelperFunctions::addUser()","'user' version in database updated.");
                    } else {
                        self::log(-1,"HelperFunctions::addUser()","Could not update database's 'user' version.");
                    }
                    $userDeleted = true;
                } else {
                    self::log(-1,"HelperFunctions::deleteUser()", "Could not delete the specified user.");
                }
            }
        } else {
            self::log(-1,"HelperFunctions::deleteUser()", "Expects integer type for \$userID.");
        }
        return $userDeleted;
    }

    //DATABASE MANAGEMENT
    private static $host = null;
    private static $user = null;
    private static $password = null;
    private static $database = null;
    /*
    This function sets the database that is worked with.
    */
    public static function setDatabaseParameters($host, $user, $password, $database) {
        if (is_string($host) && is_string($user) && is_string($password) && is_string($database)) {
            self::log(0,"HelperFunctions::setDatabaseParameters()","Setting database parameters to ".$host.",".$user.",".$password.",".$database.".");
            self::$host = $host;
            self::$user = $user;
            self::$password = $password;
            self::$database = $database;
        } else {
            self::log(-1,"HelperFunctions::setDatabaseParameters()","All arguments were not of type string.");
        }
    }

    /*
    This function should be used to do all select statements in the database
    and it will return the results as an array of associative arrays. To
    access row 1's attribute 'Name' use row[0]['Name']. Returns false if
    nothing was retrieved from the database.

    Adapted from sections of the PHP manual http://php.net/manual/en/ and
    w3schools.com
    */
    public static function retrieveData($commandString, ...$parameters) {
        //Assume failure
        $resultsArray = false;
        if (is_string($commandString)) {
            self::log(0,"HelperFunctions::retrieveData()",$commandString);
            //Try to establish connection with db
            $sqlConnection = new mysqli(self::$host, self::$user, self::$password, self::$database);
            if ($sqlConnection->connect_error) {
                die("Connection failed: " . $sqlConnection->connect_error);
            }

            //Prepare the command
            $numParams = count($parameters);
            $sqlCommand = $sqlConnection->prepare($commandString);

            //If parameters were passed
            if ($numParams > 0) {
                //Parse the parameter string
                if ($pString = self::parameterString(...$parameters)) {
                    //Bind the parameters
                    $sqlCommand->bind_param($pString, ...$parameters);
                } else {
                    //Parameters did not parse successfully
                    return false;
                }
            }

            //Execute the command
            if($sqlCommand->execute()) {
                self::log(1,"HelperFunctions::retrieveData()","Successfully retrieved data.");
            } else {
                self::log(-1,"HelperFunctions::retrieveData()",$sqlConnection->error);
            }

            //Fetch each row and store in the results array
            if($result = $sqlCommand->get_result()) {
                $resultsArray = array();
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $resultsArray[] = $row;
                }
            }

            //Close the command and connection
            $sqlCommand->close();
            $sqlConnection->close();
        } else {
            self::log(-1,"HelperFunctions::retrieveData()","Command not of type string.");
        }
        //Return the results
        return $resultsArray;
    }

    /*
    Does not handle if exists type queries. Rather use
    if(retrieveData(...)) {modifyData(...)}

    This function should be used to do all insert, delete and update
    statements in the database and it will return the number of affected
    entries and the id of the last inserted entry. [aff_rows, last_id]

    Adapted from sections of the PHP manual http://php.net/manual/en/ and
    w3schools.com
    */
    public static function modifyData($commandString, ...$parameters) {
        //Assume failure
        $rowsAffected = false;
        if (is_string($commandString)) {
            self::log(0,"HelperFunctions::modifyData()","Modify db with ".$commandString);
            //Try to establish connection with db
            $sqlConnection = new mysqli(self::$host, self::$user, self::$password, self::$database);
            if ($sqlConnection->connect_error) {
                die("Connection failed: " . $sqlConnection->connect_error);
            }

            //Prepare the command
            $numParams = count($parameters);
            $sqlCommand = $sqlConnection->prepare($commandString);

            //If parameters were passed
            if ($numParams > 0) {
                //Parse the parameter string
                if ($pString = self::parameterString(...$parameters)) {
                    //Bind the parameters
                    $sqlCommand->bind_param($pString, ...$parameters);
                } else {
                    //Parameters did not parse successfully
                    return false;
                }
            }

            //Execute the command
            if ($sqlCommand->execute()) {
                //if successful, set affected rows
                $rowsAffected = array($sqlCommand->affected_rows, $sqlCommand->insert_id);
            } else {
                self::log(-1,"HelperFunctions::modifyData()",$sqlConnection->error);
            }

            //Close the command and connection
            $sqlCommand->close();
            $sqlConnection->close();
        } else {
            self::log(-1,"HelperFunctions::modifyData()","Command not of type string.");
        }
        //Return the result
        return $rowsAffected;
    }

    /*
    This function generates the parameter type string used in bind_param().
    If there is an unrecognised type, the funtion will return false instead.

    Adapted from sections of the PHP manual http://php.net/manual/en/ and
    w3schools.com
    */
    private static function parameterString(...$parameters) {
        self::log(0,"HelperFunctions::parameterString()","Generating parameter string.");
        if (isset($parameters) && !empty($parameters)) {
            $paramTypeString = "";
            //Build the command string
            foreach ($parameters as $p) {
                switch (gettype($p)) {
                    case "integer":
                        $paramTypeString .= "i";
                        break;
                    case "double":
                        $paramTypeString .= "d";
                        break;
                    case "string":
                        $paramTypeString .= "s";
                        break;
                    default:
                        self::log(-1,"HelperFunctions::parameterString()","Parameter type not valid: ".gettype($p).".");
                        return false;
                }
            }
        } else {
            self::log(-1,"HelperFunctions::parameterString()","Parameter string not set or empty.");
            $paramTypeString = false;
        }
        self::log(0,"HelperFunctions::parameterString()","Return value: ".$paramTypeString.".");
        return $paramTypeString;
    }

    //CUSTOMER AND VENDOR
    public static function updateAccountBalance($amount, $uid) {
        if (is_numeric($amount)) {
        //switch on uid set or not
        } else {
            self::log(-1,"HelperFunctions::updateAccountBalance()","Amount parameter not numeric.");
        }
    }

    //AJAX

	public static function getUserData() {
		$returnValue = strval(false);
        $userType = self::getUserType();
        switch ($userType) {
            case 1:
				//User data response for admin
                $query = "SELECT UserID, Username, Title, FirstName, LastName, Email, ContactNumber, UserType FROM USER;";
                $userData = self::retrieveData($query);
                if ($userData) {
                    $returnValue = '[';
                    $first = true;
                    foreach ($userData as $user) {
                        if (!$first) {
                            $returnValue .= ',';
                        }
                        $uid = $user['UserID'];
                        $title = $user['Title'];
                        $firstName = $user['FirstName'];
                        $lastName = $user['LastName'];
                        $email = $user['Email'];
                        $userIndicator = $user['UserType'];
                        self::log(1,"User indicator:",$userIndicator);
                        $contactNumber = $user['ContactNumber'];
                        $returnValue .= '{"UID":'.$uid.',';
                        $returnValue .= '"Title":"'.$title.'",';
                        $returnValue .= '"fName":"'.$firstName.'",';
                        $returnValue .= '"lName":"'.$lastName.'",';
                        $returnValue .= '"Email":"'.$email.'",';
                        $returnValue .= '"UserT":"'.$userIndicator.'",';
                        if($userIndicator == 3) {
							$query1 = "SELECT TradingAs FROM VENDOR WHERE UserID = ?;";

							if($vendor = self::retrieveData($query1,$uid)){
								$returnValue .= '"Vendor":"'.$vendor[0]['TradingAs'].'",';
							} else {
								self::log(-1,"HelperFunctions::getUserData()","Could not retrieve vendor name for user.");
							}
						}
                        $returnValue .= '"Contact":"'.$contactNumber.'"}';


                        if ($first) {
                            $first = false;
                        }
                    }
                    $returnValue .= ']';
				}
                break;
            case 2:
                break;
            case 3:
                break;
            case 4:
                break;
            default:
				$returnValue = strval(false);
                break;
        }
        self::log(0,"HelperFunctions::getUserData()","JSON string: ".$returnValue);
        return $returnValue;
    }

    public static function getProductData() {
        $returnValue = strval(false);
        $userType = self::getUserType();
        switch ($userType) {
            case 1:
				//Product data response for customers
                $query = "SELECT ItemID, CompanyName, Name, Price, Description, MENU_ITEM.VendorID FROM MENU_ITEM, VENDOR WHERE MENU_ITEM.VendorID = VENDOR.VendorID;";
                $productData = self::retrieveData($query);
                if ($productData) {
                    $returnValue = '[';
                    $first = true;
                    foreach ($productData as $product) {
                        if (!$first) {
                            $returnValue .= ',';
                        }
                        $pid = $product['ItemID'];
                        $vendorName = $product['CompanyName'];
                        $productName = $product['Name'];
                        $itemPrice = $product['Price'];
                        $itemDescription = $product['Description'];
                        $returnValue .= '{"PID":'.$pid.',';
                        $returnValue .= '"VID":"'.$vendorName.'",';
                        $returnValue .= '"Vendor":"'.$vendorName.'",';
                        $returnValue .= '"Name":"'.$productName.'",';
                        $returnValue .= '"Price":'.$itemPrice.',';
                        $returnValue .= '"Description":"'.$itemDescription.'"}';
                        if ($first) {
                            $first = false;
                        }
                    }
                    $returnValue .= ']';
				}
                break;
            case 2:
                //Product data response for customers
                $query = "SELECT ItemID, CompanyName, Name, Price, Description, MENU_ITEM.VendorID FROM MENU_ITEM, VENDOR WHERE MENU_ITEM.VendorID = VENDOR.VendorID;";
                $productData = self::retrieveData($query);
                if ($productData) {
                    $returnValue = '[';
                    $first = true;
                    foreach ($productData as $product) {
                        if (!$first) {
                            $returnValue .= ',';
                        }
                        $pid = $product['ItemID'];
                        $vendorName = $product['CompanyName'];
                        $productName = $product['Name'];
                        $itemPrice = $product['Price'];
                        $itemDescription = $product['Description'];
                        $returnValue .= '{"PID":'.$pid.',';
                        $returnValue .= '"VID":"'.$vendorName.'",';
                        $returnValue .= '"Vendor":"'.$vendorName.'",';
                        $returnValue .= '"Name":"'.$productName.'",';
                        $returnValue .= '"Price":'.$itemPrice.',';
                        $returnValue .= '"Description":"'.$itemDescription.'"}';
                        if ($first) {
                            $first = false;
                        }
                    }
                    $returnValue .= ']';
                }
                break;
            case 3:
                break;
            case 4:
                break;
            default:
                //Product data response for unregistered users
                $query = "SELECT ItemID, CompanyName, Name, Price, Description, MENU_ITEM.VendorID FROM MENU_ITEM, VENDOR WHERE MENU_ITEM.VendorID = VENDOR.VendorID;";
                $productData = self::retrieveData($query);
                if ($productData) {
                    $returnValue = '[';
                    $first = true;
                    foreach ($productData as $product) {
                        if (!$first) {
                            $returnValue .= ',';
                        }
                        $pid = $product['ItemID'];
                        $vendorName = $product['CompanyName'];
                        $productName = $product['Name'];
                        $itemPrice = $product['Price'];
                        $itemDescription = $product['Description'];
                        $returnValue .= '{"PID":'.$pid.',';
                        $returnValue .= '"VID":"'.$vendorName.'",';
                        $returnValue .= '"Vendor":"'.$vendorName.'",';
                        $returnValue .= '"Name":"'.$productName.'",';
                        $returnValue .= '"Price":'.$itemPrice.',';
                        $returnValue .= '"Description":"'.$itemDescription.'"}';
                        if ($first) {
                            $first = false;
                        }
                    }
                    $returnValue .= ']';
                }
                break;
        }
        self::log(0,"HelperFunctions::getProductData()","JSON string: ".$returnValue);
        return $returnValue;
    }
    
     public static function getVendorData() {
        $returnValue = strval(false);
        $userType = self::getUserType();
        switch ($userType) {
            case 1:
            $query = "SELECT VendorID,CompanyName FROM VENDOR;";
                $vendorData = self::retrieveData($query);
                if ($vendorData) {
                    $returnValue = '[';
                    $first = true;
                    foreach ($vendorData as $vendor) {
                        if (!$first) {
                            $returnValue .= ',';
                        }
                        $vid = $vendor['VendorID'];
                        $vendorName = $vendor['CompanyName'];
                        $returnValue .= '{"VID":'.$vid.',';
                        $returnValue .= '"Vendor":"'.$vendorName.'"}';                        
                        if ($first) {
                            $first = false;
                        }
                    }
                    $returnValue .= ']';
                }
            
                break;
            case 2:
                //Product data response for customers
                
                break;
            case 3:
                break;
            case 4:
                break;
            default:
                //Product data response for unregistered users
                break;
        }
        self::log(0,"HelperFunctions::getVendorData()","JSON string: ".$returnValue);
        return $returnValue;
    }
    
    public static function getDataVersion($dataType) {
        $returnValue = strval(false);
        if (is_string($dataType)){
            $userType = self::getUserType();
            if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
                $userID = $_SESSION['uid'];
            } else {
                $userID = -1;
            }
            if($databaseVersion = self::retrieveData("SELECT Version FROM DB_TRACKER WHERE Property = ?;", $dataType)) {
                $databaseVersion = $databaseVersion[0]['Version'];
                //The following is based on the cantor pairing function
                $dataVersionIndicator = (int) (((($databaseVersion + $userType)*($databaseVersion + $userType + 1))/2) + $userType);
                $dataVersionIndicator = (int) (((($dataVersionIndicator + $userID)*($dataVersionIndicator + $userID + 1))/2) + $userID);
                $returnValue = strval($dataVersionIndicator);
                self::log(0,"HelperFunctions::getProductDataVersion()","JSON string: ".$returnValue);
            } else {
                self::log(-1,"HelperFunctions::getProductDataVersion()","Could not retrieve the specified data version.");
            }
        } else {
            self::log(-1,"HelperFunctions::getDataVersion(".strval($dataType).")","Parameter not of type string.");
        }
        return $returnValue;
    }

    public static function getProductDataVersion() {
        $returnValue = strval(false);
        $userType = self::getUserType();
        if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
            $userID = $_SESSION['uid'];
        } else {
            $userID = -1;
        }
        if($databaseVersion = self::retrieveData("SELECT Version FROM DB_TRACKER;")) {
            $databaseVersion = $databaseVersion[0]['Version'];
            //The following is based on the cantor pairing function
            $dataVersionIndicator = (int) (((($databaseVersion + $userType)*($databaseVersion + $userType + 1))/2) + $userType);
            $dataVersionIndicator = (int) (((($dataVersionIndicator + $userID)*($dataVersionIndicator + $userID + 1))/2) + $userID);
            $returnValue = strval($dataVersionIndicator);
            self::log(0,"HelperFunctions::getProductDataVersion()","JSON string: ".$returnValue);
        } else {
            self::log(-1,"HelperFunctions::getProductDataVersion()","JSON string: ".$returnValue);
        }
        return $returnValue;
    }
}

if (isset($_GET['AJAX_Request'])) {
    $ajaxRequest = $_GET['AJAX_Request'];
    HelperFunctions::simpleSessionResume();
    HelperFunctions::log(0,"HelperFunctions.php?AJAX_Request","Client requested: ".$ajaxRequest);
    $response = 'false';
    $ignoreResponseLog = false;
    switch ($ajaxRequest) {
		case 'vendorData': //JSON
            $response = HelperFunctions::getVendorData();
            break;
        case 'vendorDataVersion': //JSON
            //$response = HelperFunctions::getProductDataVersion();
            $response = HelperFunctions::getDataVersion('vendor');
            break;
		case 'userData': //JSON
			HelperFunctions::log(1,"IT GOT HERE1:","HELLO1");
            $response = HelperFunctions::getUserData();
            break;
        case 'userDataVersion': //JSON
            //$response = HelperFunctions::getProductDataVersion();
            HelperFunctions::log(1,"IT GOT HERE:","HELLO");
            $response = HelperFunctions::getDataVersion('user');
            break;
        case 'productData': //JSON
            $response = HelperFunctions::getProductData();
            break;
        case 'productDataVersion': //JSON
            //$response = HelperFunctions::getProductDataVersion();
            $response = HelperFunctions::getDataVersion('product');
            break;
        case 'userJavascript': //JSON
            $response = HelperFunctions::userScriptPath();
            break;
        case 'logContent': //HTML
            if(isset($_SESSION['log']) && !empty($_SESSION['log'])) {
                $response = $_SESSION['log']->generateLogContentHtml();
            } else {
                $response = "<p>LOG NOT SET</p>";
            }
            $ignoreResponseLog = true;
            break;
        case 'saveLog': //Text
            if(isset($_SESSION['log']) && !empty($_SESSION['log'])) {
                $_SESSION['log']->saveToFile();
                $response = 'Log saved to file';
            } else {
                $response = 'No log to save to file';
            }
            break;
        default:
            //If the request is not recognised, return the JSON false string
            $response = 'false';
            break;
    }
    if (!$ignoreResponseLog) {
        HelperFunctions::log(0,"HelperFunctions.php?AJAX_Request","Server response: ".$response);
    }
    echo $response;
}
?>
