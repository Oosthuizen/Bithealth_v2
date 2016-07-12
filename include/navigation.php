<!-- navigation bar -->
<!-- Applicable to all users -->
<?php
require_once("ajax/jqSajax.class.php");
//session_start();

    if (isset($_SESSION['Login'])) {
            $user = json_decode($_SESSION['user']);

            $url = "http://discotestcloud.cloudapp.net/Service1.svc/GetWeather";
            $client = curl_init($url);
            curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
            $response = curl_exec($client);
            curl_close($client);
            $_SESSION['we'] = $response;
            $weather = json_decode($_SESSION['we']);
    }else{
        exit();
    }
?>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-5.jpg" style="background-image: url('assets/img/sidebar-5.jpg');">

    <!--
        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->
        <!--side navbar-->
        <div class="sidebar-wrapper">
            <div class="logo">
                <a class="simple-text" style="letter-spacing: 5px">Bit | health</a>
            </div>
            <ul class="nav">
                <li>
                    <a href="dashboard.php">
                        <i class="pe-7s-display2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="progress.php">
                        <i class="pe-7s-graph"></i>
                        <p>Progress</p>
                    </a>
                </li>
                <li>
                    <a href="gym.php">
                        <i class="pe-7s-gym"></i>
                        <p>Activity</p>
                    </a>
                </li>
                <li>
                    <a href="leaderboard.php">
                        <i class="pe-7s-diamond"></i>
                        <p>Leaderboard</p>
                    </a>
                </li>
                
            </ul>
        </div> <!--side navbar end-->
    </div> <!--sidebar end-->

    <div class="main-panel">
        <!--top navbar-->
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
<!-- ************ display username-->
                <a class="navbar-brand" href="#">Welcome <?php echo $user->Name ." " .$user->SurName?></a>
            </div>
            <div class="collapse navbar-collapse">
             <ul class="nav navbar-nav navbar-right">
<!-- ************* display weather-->
                    <li>
                        <a><?php echo $weather; ?></a>
                        <!-- <a>19c:at Johannesburg</a>-->
                    </li>
                    <li>
                        <a id = "dateBox">
                            <script type="text/javascript">
                            document.getElementById("dateBox").innerHTML = new Date().toDateString();
                            </script>
                        </a>
                    </li>
                    <li>
<!-- ******************* log out-->
                        <a href="login.php">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
