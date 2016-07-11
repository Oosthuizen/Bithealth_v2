<!DOCTYPE html>
<!-- This servers to open all the tags until content can be written for every
default page of the qnot.co.za site. -->
<html lang="en">
    <head>
        <?php
            include __DIR__.'/header.php';
            //$title must be set in the page using this
            echo "<title>" . $title . "</title>";
        ?>
     </head>
    <body>
    <?php
        if (isset($_SESSION['log']) && !empty($_SESSION['log'])) {
            print $_SESSION['log']->generateLogHtml();
        }
    ?>
<!-- The content will go below and then be followed by including the
closeHTML.php file after it -->
