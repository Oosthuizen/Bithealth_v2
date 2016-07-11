<?php
    $title = "BitHealth | DASHBOARD";
?>

<?php include __DIR__."/include/openHTML.php"; ?>
<?php include __DIR__."/include/navigation.php"; ?>

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
                                <h4 class="title" style="padding-bottom:10px"> Jihyun, 22 <i class="pe-7s-female" style="font-size: 25px; margin-left: 3px; line-height: 10px; width: 25px;"></i><br />
                                    <small>Midrand, Gauteng, South Africa</small>
                                </h4>
<!-- ***************************bmi value and color needs to change according to bmi-->
                                <h1 class="title" style="padding-bottom: 50px; padding-top: 25px"> Your BMI is <b style="color: green">20.45 kg/m<sup>2</sup></b>  </h1>
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
                            <h4 class="title">Today's Weather</h4>
                        </div>
<!-- ******************* real time weather-->
                        <div class="content">
                            <h2 class="title" style="text-align: center"><b><i class="pe-7s-cloud" style="font-size: 82px"></i></b><br/>Wear Jacket!</h2>
                            <h4 class="title" style="text-align: center">11 C outside in Midrand </h4>
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
                        <!--chart.js chart here-->
                        <canvas id="waterChart" height="100px"></canvas>
                    </div> <!--content end-->
                </div> <!-- card end-->
            </div> <!-- col 1 end-->

            <div class="col-sm-4">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Distance</h4>
                        <p class="category">How far do you need to run today?</p>
                    </div>
                    <div class="content">
                        <!--chart.js chart here-->
                        <canvas id="bmiChart" height="100px"></canvas>
                    </div> <!--content end-->
                </div> <!-- card end-->
            </div> <!-- col 2 end-->

            <div class="col-sm-4">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Time</h4>
                        <p class="category">How much do you need to spend the time today?</p>
                    </div>
                    <div class="content">
                        <!--chart.js chart here-->
                        <canvas id="bmiChart" height="100px"></canvas>
                    </div> <!--content end-->
                </div> <!-- card end-->
            </div><!-- col 3 end-->
        </div> <!--second row end-->
    </div> <!-- container-fluid end-->
</div> <!--content end-->
<!-- end of content-->
<?php include __DIR__."/include/footer.php"; ?>
<?php include __DIR__."/include/closeHTML.php"; ?>
