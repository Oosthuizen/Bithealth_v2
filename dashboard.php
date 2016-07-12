<?php
require_once("ajax/jqSajax.class.php");
session_start();
$title = "BitHealth | DASHBOARD";


    if (isset($_SESSION['Login'])) {
        $user = json_decode($_SESSION['user']);

        $url = "http://discotestcloud.cloudapp.net/Service1.svc/GetWeather";
        $client = curl_init($url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
        $response = curl_exec($client);
        curl_close($client);

        $url = "http://discotestcloud.cloudapp.net/Service1.svc/getdistance/$user->Age/$user->wight/$user->Length/$user->BMI";
        $client = curl_init($url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
        $response1 = curl_exec($client);
        curl_close($client);

        $hour = explode(" ", $response);
        $url = "http://discotestcloud.cloudapp.net/Service1.svc/getRunTime/18";
        $client = curl_init($url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
        $response2 = curl_exec($client);
        curl_close($client);

        var_dump($response2);

        $idealTime = explode("-", $response2);

        $time = explode(" ", $idealTime[0]);
        $format = $time[1];
        $hr = explode(":" , $time[0]);

        //var_dump($user->Age);
    }else{
        //header("Location: http://localhost/SurfWeb/login.php"); /* Redirect browser */
        exit();
    }


?>

<?php include __DIR__."/include/openHTML.php"; ?>
<?php echo '<link href="assets/css/running.css" rel="stylesheet" />'; ?>
<?php echo '<link href="assets/css/clock.css" rel="stylesheet" />'; ?>
<?php include __DIR__."/include/navigation.php"; ?>
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" style="display: none;">
  <symbol id="wave">
    <path d="M420,20c21.5-0.4,38.8-2.5,51.1-4.5c13.4-2.2,26.5-5.2,27.3-5.4C514,6.5,518,4.7,528.5,2.7c7.1-1.3,17.9-2.8,31.5-2.7c0,0,0,0,0,0v20H420z"></path>
    <path d="M420,20c-21.5-0.4-38.8-2.5-51.1-4.5c-13.4-2.2-26.5-5.2-27.3-5.4C326,6.5,322,4.7,311.5,2.7C304.3,1.4,293.6-0.1,280,0c0,0,0,0,0,0v20H420z"></path>
    <path d="M140,20c21.5-0.4,38.8-2.5,51.1-4.5c13.4-2.2,26.5-5.2,27.3-5.4C234,6.5,238,4.7,248.5,2.7c7.1-1.3,17.9-2.8,31.5-2.7c0,0,0,0,0,0v20H140z"></path>
    <path d="M140,20c-21.5-0.4-38.8-2.5-51.1-4.5c-13.4-2.2-26.5-5.2-27.3-5.4C46,6.5,42,4.7,31.5,2.7C24.3,1.4,13.6-0.1,0,0c0,0,0,0,0,0l0,20H140z"></path>
  </symbol>
</svg>
<div class="content" >
    <div class="container-fluid" >
        <div class="row">
            <div class="col-sm-9">
                <div class="card">
                    <div class="card card-user">
                        <div class="image" style="background-color: #1F77D0; opacity: 0.7">
                        </div>
                        <div class="content">
                            <div class="author">
                                <img class="avatar border-gray" src="assets/img/running.jpg" alt="..."/>
<!-- *****************************user name, age, gender here-->
                                <h4 class="title" style="padding-bottom:10px"> <?php echo $user->Name?>, <?php echo $user->Age ?> <i class="pe-7s-male" style="font-size: 25px; margin-left: 3px; line-height: 10px; width: 25px;"></i><br />
                                    <small>Midrand, Gauteng, South Africa</small>
                                </h4>
<!-- ***************************bmi value and color needs to change according to bmi-->
                                <h2 class="title" style="padding-bottom: 50px; padding-top: 25px; width: auto; "> Your BMI is <?php 
                                 if($user->BMI < 18.5 || ($user->BMI >= 25 && $user->BMI < 30 ) ){
                                    echo '<b style="color:orange">'.$user->BMI;
                                 }
                                 else if($user->BMI >= 18.6 && $user->BMI < 24.9){
                                    echo '<b style="color:green">'.$user->BMI;
                                 }
                                 else{
                                    echo '<b style="color:red">' .$user->BMI;
                                 }
                                ?>
                                kg/m<sup>2</sup></b>  </h2>
                                <p class="description text-center" style="font-style: italic;">You don't get the ass you want by sitting on it.</p>
                            </div> <!--author end-->
                        </div> <!-- content end-->
                    </div>
                </div>
            </div> <!--col end-->

<!-- ********Daily activities here here-->
            <div class="col-sm-3">
                <div class="row">
                <div class="col-sm-12">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">Your BMI Legend</h4>
                    </div>
                    <div class="content">
                        <div class="table-full-width">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <i class="fa fa-circle text-warning"></i>
                                                </td>
                                                <td>
                                                    Underweight
                                                </td>
                                                <td class="td-actions text-right"> < 18.5 </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="fa fa-circle text-success"></i>
                                                </td>
                                                <td>
                                                    Normal
                                                </td>
                                                <td class="td-actions text-right">18.6 - 24.9</td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="fa fa-circle text-warning"></i>
                                                </td>
                                                <td>Overweight</td>
                                                <td class="td-actions text-right">25 - 29.9</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="fa fa-circle text-danger"></i>
                                                </td>
                                                <td>Obese</td>
                                                <td class="td-actions text-right"> > 30</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                    </div>
                </div><!--card end-->
                </div> <!-- col-sm-12 end-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Your Points</h4>
                        </div>
<!-- ******************* real time points-->
                        <div class="content">
                            <h2 class="title" style="text-align: center; letter-spacing: 3px"><b><i class="pe-7s-medal" style="font-size: 30px; padding: 5px"></i></b><?php echo $user->Points; ?></h2>
                            <h4 class="title" style="text-align: center"> Stay fit! </h4>
                        </div> <!-- content end-->
                    </div> <!--  card end-->
                </div> <!-- second col-sm-12 -->
                </div> <!-- inside row end-->
            </div> <!--col end-->
        </div> <!-- row end-->
<!-- ****info about water, distance to run, time to spend-->
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Water Consumption</h4>
                        <p class="category">How much do you need to drink today?</p>
                    </div>
                    <div class="content">
<!-- ********************water -->                        
                        <!--chart.js chart here-->
                        <div class="ct-perfect-fourth">
                            <h2 class="title" style="padding-bottom: 50px; padding-top: 25px; text-align: center;"> <b><span id="count"><?php echo ($user->WaterIn)*0.01; ?></span> </b>L  </h2>

                            <!--<canvas id="waterChart" height="100px"></canvas>-->
                            <div class="page">
                            <div id="water" class="water">
                                <svg viewBox="0 0 560 20" class="water__wave water__wave_back">
                                  <use xlink:href="#wave"></use>
                              </svg>
                              <svg viewBox="0 0 560 20" class="water__wave water__wave_front">
                                  <use xlink:href="#wave"></use>
                              </svg>
                              <div class="water__inner">
                                  <div class="bubble bubble_1"></div>
                                  <div class="bubble bubble_2"></div>
                                  <div class="bubble bubble_3"></div>
                              </div>
                            </div>
                            </div>
                        </div>
                    </div> <!--content end-->
                </div> <!-- card end-->
            </div> <!-- col 1 end-->
<!-- ********distance-->
            <div class="col-sm-4">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Distance</h4>
                        <p class="category">How far do you need to run today?</p>
                    </div>
                    <div class="content">

                        <!--chart.js chart here-->
                        <div class="ct-perfect-fourth">
                            <h2 class="title" style="padding-bottom: 50px; padding-top: 25px; text-align: center;"> <b><span id="count"><?php echo json_decode($response1); ?></span> </b>m  </h2>
                            
                            <div id="main" class="page page-home" style="height:200px; width: auto">
                            <div class="pack pack-1">
                                <div class="runner running">
                                    <div class="wrap">
                                        <div class="body">
                                        <div class="arm">
                                            <div class="left-hand">
                                              <div class="wrist"></div>
                                            </div> <!-- left hand end-->
                                            <div class="chest">
                                                <div class="head">
                                                    <div class="neck"></div>
                                                </div>
                                                <div class="hip">
                                                    <div class="left-leg">
                                                        <div class="instep"></div>
                                                    </div>
                                                    <div class="right-leg">
                                                        <div class="instep"></div>
                                                    </div>
                                                </div>
                                            </div> <!--chest end-->
                                            <div class="right-hand">
                                                <div class="wrist"></div>
                                            </div> <!--right hand end-->
                                        </div> <!-- arm end-->
                                        </div> <!-- body end-->
                                    </div> <!-- wrap end-->
                                </div> <!-- runner end-->

                                <div class="ground" style="margin:0"></div>
                            </div> <!--pack end-->
                            </div> <!-- main end-->
                        </div>
                    </div> <!--content end-->
                </div> <!-- card end-->
            </div> <!-- col 2 end-->

 <!--*********time-->            
            <div class="col-sm-4">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Time</h4>
                        <p class="category">How long do you need to exercise today?</p>
                    </div>
                    <div class="content">
                        <!--chart.js chart here-->
                        <div class="ct-perfect-fourth">
                            <h2 class="title" style="padding-bottom: 50px; padding-top: 25px; padding-bottom: 5px;text-align: center;"> <b><span id="count"><?php echo $hr[0]  ."</span> : <span id=\'count\'" .$hr[1] ."</span></b>" .$format; ?></h2>
                            <div class="clock">
                              <div class="top"></div>
                              <div class="right"></div>
                              <div class="bottom"></div>
                              <div class="left"></div>
                              <div class="center"></div>
                              <div class="shadow"></div>
                              <div class="hour"></div>
                              <div class="minute"></div>
                              <div class="second"></div>
                            </div> <!-- clock end-->
                        </div>
                    </div> <!--content end-->
                </div> <!-- card end-->
            </div><!-- col 3 end-->
        </div> <!--second row end-->
        <script type="text/javascript">
            $("span").each(function () {
                if($(this).is("#count")) {
                    $(this).prop('Counter',0).animate({
                        Counter: $(this).text()
                    }, {
                        duration: 4000,
                        easing: 'swing',
                        step: function (now) {
                            $(this).text(Math.ceil(now));
                        }
                    });
                }

            });
        </script>
    </div> <!-- container-fluid end-->
</div> <!--content end-->

<!-- end of content-->
<?php include __DIR__."/include/footer.php"; ?>
<?php include __DIR__."/include/closeHTML.php"; ?>
