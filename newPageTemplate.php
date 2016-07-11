<?php /*global variables here*/
$title = "BitHealth | PROGRESS";
?>

<?php include __DIR__."/include/openHTML.php"; ?>
<?php echo '<link href="assets/css/rotating-card.css" rel="stylesheet">'?>
<?php include __DIR__."/include/navigation.php";?>
<!-- CONTENT BEGIN -->

<div class="content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card-container">
                        <div class="card">
                            <div class="front">
                                <h1 style="text-align: center">Running Stuff </h1>
                                <canvas id="runChart" height="240px" width="auto" style="padding-left: 10px"></canvas> <!-- ct-major-sixth -->
                                <script>
                                    var data = {
                                        labels: ["January", "February", "March", "April", "May", "June", "July"],
                                        datasets: [
                                            {
                                                label: "My First dataset",
                                                fillColor: "#1F77D0",
                                                strokeColor: "#1F77D0",
                                                backgroundColor: "#1F77D0",
                                                borderColor: "#1F77D0",
                                                borderWidth: 2,
                                                hoverBackgroundColor: "##1F77D0",
                                                hoverBorderColor: "#1F77D0",
                                                data: [65, 59, 80, 81, 56, 55, 40],
                                            }
                                        ]
                                    };
                                    /*
                                     var myBarChart = new Chart(ctx, {
                                     type: "bar",
                                     data: data
                                     });*/
                                    var ctx = document.getElementById("runChart").getContext("2d");
                                    new Chart(ctx).Bar(data);
                                </script>
                                <hr/>
                                <div style="text-align: center">
                                    <i class="fa fa-mail-forward"></i>Auto Rotation
                                    </div>
                            </div>
                            <!-- End front -->
                            <!-- Back of card start-->
                            <div class="back">
                                <div class="content">
                                    <h1> QWERTYEWQYUYREW
                                        QWEREWQWERT</h1>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End col-->


                    <!-- 2nd End-->
                </div>
                <!--2nd start-->
                <div class="col-md-6">
                    <div class="card-container">
                        <div class="card">
                            <div class="front">
                                <h1 style="text-align: center">Water Stuff </h1>
                                <canvas id="waterChart" height="115px" width="auto" style="padding-left: 10px"></canvas>
                                <script>
                                    var doughnutData = [
                                        {
                                            value: 30,
                                            color: "#a3e1d4",
                                            highlight: "#1ab394",
                                            label: "running"
                                        },

                                        {
                                            value: 70,
                                            color: "#b5b8cf",
                                            highlight: "#1ab394",
                                            label: "yoga"
                                        }
                                    ];

                                    var doughnutOptions = {
                                        segmentShowStroke: true,
                                        segmentStrokeColor: "#fff",
                                        segmentStrokeWidth: 2,
                                        percentageInnerCutout: 45, // This is 0 for Pie charts
                                        animationSteps: 100,
                                        animationEasing: "easeOutBounce",
                                        animateRotate: true,
                                        animateScale: false,
                                        responsive: true,
                                    };


                                    var ctx3 = document.getElementById("waterChart").getContext("2d");
                                    var myNewChart3 = new Chart(ctx3).Doughnut(doughnutData, doughnutOptions);

                                </script>
                                <hr/>
                                <div style="text-align: center">
                                    <i class="fa fa-mail-forward"></i>Auto Rotation
                                </div>
                            </div>
                            <!-- End front -->
                            <!-- Back of card start-->
                            <div class="back">
                                <div class="content">
                                    <h1> QWERTYEWQYUYREW
                                        QWEREWQWERT</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row 2-->
             <div class="row">
                <div class="col-sm-6">
                <div class="card-container">
                    <div class="card">
                        <div class="front">
                            <h1 style="text-align: center">BMI Stuff </h1>
                            <canvas id="bmiChart" height="115px" width="auto" style="padding-left: 10px"></canvas>
                            <script>
                                var lineData = {
                                    labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
                                    datasets: [
                                        {
                                            label: "Activity dataset",
                                            fillColor: "rgba(220,220,220,0.5)",
                                            strokeColor: "#db162f",
                                            pointColor: "#db162f",
                                            pointStrokeColor: "#db162f",
                                            pointHighlightFill: "#fff",
                                            pointHighlightStroke: "#1F77D0",
                                            data: [5, 2, 2, 1, 0.5, 3, 3]
                                        }

                                    ]
                                };

                                var lineOptions = {
                                    scaleShowGridLines: true,
                                    scaleGridLineColor: "rgba(0,0,0,.05)",
                                    scaleGridLineWidth: 1,
                                    bezierCurve: true,
                                    bezierCurveTension: 0.4,
                                    pointDot: true,
                                    pointDotRadius: 4,
                                    pointDotStrokeWidth: 1,
                                    pointHitDetectionRadius: 20,
                                    datasetStroke: true,
                                    datasetStrokeWidth: 2,
                                    datasetFill: true,
                                    responsive: true,
                                };


                                var ctx = document.getElementById("bmiChart").getContext("2d");
                                var myNewChart = new Chart(ctx).Line(lineData, lineOptions);
                            </script>
                            <hr/>
                            <div style="text-align: center">
                                <i class="fa fa-mail-forward"></i>Auto Rotation
                            </div>
                        </div>
                        <!-- End front -->
                        <!-- Back of card start-->
                        <div class="back">
                            <div class="content">
                                <h1> QWERTYEWQYUYREW
                                    QWEREWQWERT</h1>
                            </div>
                        </div>
                    </div>
                </div> <!-- End col-->


                <!-- 2nd End-->
            </div>
                 <!--2nd start-->
                 <div class="col-md-6">
                <div class="card-container">
                    <div class="card">
                        <div class="front">
                            <h1 style="text-align: center">Activity Stuff </h1>
                            <canvas id="radarChart" height="115px" width="auto" style="padding-left: 10px"></canvas>
                            <script>
                                var radarData = {
                                    labels: ["Eating", "Drinking", "Sleeping", "Cycling", "Running"],
                                    datasets: [
                                        {
                                            label: "My First dataset",
                                            fillColor: "rgba(220,220,220,0.2)",
                                            strokeColor: "rgba(220,220,220,1)",
                                            pointColor: "rgba(220,220,220,1)",
                                            pointStrokeColor: "#fff",
                                            pointHighlightFill: "#fff",
                                            pointHighlightStroke: "rgba(220,220,220,1)",
                                            data: [65, 59, 90, 55, 40]
                                        }
                                    ]
                                };

                                var radarOptions = {
                                    scaleShowLine: true,
                                    angleShowLineOut: true,
                                    scaleShowLabels: false,
                                    scaleBeginAtZero: true,
                                    angleLineColor: "rgba(0,0,0,.1)",
                                    angleLineWidth: 1,
                                    pointLabelFontFamily: "'Arial'",
                                    pointLabelFontStyle: "normal",
                                    pointLabelFontSize: 10,
                                    pointLabelFontColor: "#666",
                                    pointDot: true,
                                    pointDotRadius: 3,
                                    pointDotStrokeWidth: 1,
                                    pointHitDetectionRadius: 20,
                                    datasetStroke: true,
                                    datasetStrokeWidth: 2,
                                    datasetFill: true,
                                    responsive: true,
                                }

                                var ctx = document.getElementById("radarChart").getContext("2d");
                                new Chart(ctx).Radar(radarData, radarOptions);

                            </script>
                            <hr/>
                            <div style="text-align: center">
                                <i class="fa fa-mail-forward"></i>Auto Rotation
                            </div>
                        </div>
                        <!-- End front -->
                        <!-- Back of card start-->
                        <div class="back">
                            <div class="content">
                                <h1> QWERTYEWQYUYREW
                                    QWEREWQWERT</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             </div>
            <!-- Row 2 End-->
            <!-- Row 3 start-->
             <div class="row">
                 <div class="col-sm-6">
                <div class="card-container">
                    <div class="card">
                        <div class="front">
                            <h1 style="text-align: center">Running Stuff </h1>
                            <canvas id="activityChart" height="auto" width="600px" style="padding-left: 10px"></canvas>
                            <script>
                                var data = {
                                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                                    datasets: [
                                        {
                                            label: "My First dataset",
                                            fillColor: "#1F4961",
                                            strokeColor: "#95877A",
                                            backgroundColor: "#1F4961",
                                            borderColor: "#95877A",
                                            borderWidth: 2,
                                            hoverBackgroundColor: "#FFF1E3",
                                            hoverBorderColor: "#132845",
                                            data: [65, 59, 80, 81, 56, 55, 40],
                                        }
                                    ]
                                };
                                /*
                                 var myBarChart = new Chart(ctx, {
                                 type: "bar",
                                 data: data
                                 });*/
                                var ctx = document.getElementById("activityChart").getContext("2d");
                                new Chart(ctx).Bar(data);
                            </script>
                            <hr/>
                            <div style="text-align: center">
                                <i class="fa fa-mail-forward"></i>Auto Rotation
                            </div>
                        </div>
                        <!-- End front -->
                        <!-- Back of card start-->
                        <div class="back">
                            <div class="content">
                                <h1> QWERTYEWQYUYREW
                                    QWEREWQWERT</h1>
                            </div>
                        </div>
                    </div>
                </div> <!-- End col-->


                <!-- 2nd End-->
            </div>
                 <!--2nd start-->
                 <div class="col-md-6">
                <div class="card-container">
                    <div class="card">
                        <div class="front">
                            <h1 style="text-align: center">Running Stuff </h1>
                            <canvas id="runningChart" height="auto" width="600px" style="padding-left: 10px"></canvas>
                            <script>
                                var data = {
                                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                                    datasets: [
                                        {
                                            label: "My First dataset",
                                            fillColor: "#1F4961",
                                            strokeColor: "#95877A",
                                            backgroundColor: "#1F4961",
                                            borderColor: "#95877A",
                                            borderWidth: 2,
                                            hoverBackgroundColor: "#FFF1E3",
                                            hoverBorderColor: "#132845",
                                            data: [65, 59, 80, 81, 56, 55, 40],
                                        }
                                    ]
                                };
                                /*
                                 var myBarChart = new Chart(ctx, {
                                 type: "bar",
                                 data: data
                                 });*/
                                var ctx = document.getElementById("runningChart").getContext("2d");
                                new Chart(ctx).Bar(data);
                            </script>
                            <hr/>
                            <div style="text-align: center">
                                <i class="fa fa-mail-forward"></i>Auto Rotation
                            </div>
                        </div>
                        <!-- End front -->
                        <!-- Back of card start-->
                        <div class="back">
                            <div class="content">
                                <h1> QWERTYEWQYUYREW
                                    QWEREWQWERT</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             </div>
            <!-- Row 3 End-->
    </div>
</div> <!-- content end-->

<!-- CONTENT END -->
<?php include __DIR__."/include/footer.php"; ?>
<?php include __DIR__."/include/closeHTML.php"; ?>

