<?php /*global variables here*/
require_once("ajax/jqSajax.class.php");
session_start();
$title = "BitHealth | PROGRESS";
if (isset($_SESSION['Login'])) {
    $user = json_decode($_SESSION['user']);

    $url = "http://discotestcloud.cloudapp.net/Service1.svc/GetAllActivitys";
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
    $response = curl_exec($client);
    curl_close($client);

    $temp = json_decode($response);
    $temp = json_decode($temp->GetAllActivitysResult);

    $url = "http://discotestcloud.cloudapp.net/Service1.svc/getWeather";
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
    $response1 = curl_exec($client);
    curl_close($client);

    $temp = explode(" ",$response1);

    $BMI = $user->BMI;
    $Ideal = $user->WaterIn;

    $url = "http://discotestcloud.cloudapp.net/Service1.svc/getReqWater/$BMI/18";
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
    $response2 = curl_exec($client);
    curl_close($client);

}else{
    //header("Location: http://localhost/SurfWeb/login.php"); /* Redirect browser */
    exit();
}
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
                                <h1 style="text-align: center ">Kilometers run per week:</h1>
                                <canvas id="runChart" height="240px" width="auto" style="padding-left: 10px"></canvas> <!-- ct-major-sixth -->

                                <script>
                                    var data = {
                                        labels: ["Week 1", "Week 2", "Week 3", "Week 4", "Week 5", "Week 6", "Week 7"],
                                        datasets: [
                                            {
                                                label: "Kilometers",
                                                fillColor: "#87CB16",
                                                strokeColor: "#87CB16",
                                                backgroundColor: "#87CB16",
                                                borderColor: "#87CB16",
                                                borderWidth: 2,
                                                hoverBackgroundColor: "#1F77D0",
                                                hoverBorderColor: "#1F77D0",
                                                data: [15, 21, 18, 14, 21, 20, 19],
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
                                    document.getElementById("legendDiv").innerHTML = cc.generateLegend();
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
                                    <p style="font-style: italic; text-align: center">"Don't ask me why I run... Ask yourself why you dont't?"<small> - Unknown</small></p>
                                    <hr/>
                                    <h4>Why People Should Run More Often!</h4>
                                    <p style="text-align: justify">Running is the most accessible of aerobic sports.  There's no question running is one of the best ways to improve your fitness quickly, lose weight, inches and feel great about yourself.  The term has been in use since at least the early 1980s when it was used to describe a more adventurous form of jogging where the runner would incorporate a variety of movements transforming a jogging session into a more demanding, enjoyable and expressive physical experience. Running is a flexible method of training.  You can run anywhere without fancy equipment. Running is inexpensive and easy to learn.  Running is a great way to start the day and it's a great way to clear your head. </p>
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
                                <h1 style="text-align: center">Water Intake:</h1>
                                <canvas id="waterChart" height="75px" width="auto" style="padding-left: 10px"></canvas>
                                <ul>
                                    <li style="color: #1DC7EA"><span>Water Consumed</span></li>
                                    <li style="color: #1D62F0"><span>Ideal Consumption Level</span></li>
                                </ul>
                                <script>
                                    var doughnutData = [
                                        {
                                            value: <?php echo $response2; ?>,
                                            color: "#1D62F0",
                                            highlight: "#1D62F0",
                                            label: "Water drank."
                                        },

                                        {
                                            value: <?php echo $Ideal; ?>,
                                            color: "#1DC7EA",
                                            highlight: "#1ab394",
                                            label: "Ideal Water Intake."
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
                                    var cc = new Chart(ctx3).Doughnut(doughnutData, doughnutOptions);
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
                                    <p style="font-style: italic; text-align: center">"Water is the only drink for a wise man."<small> - Henry David Thoreau</small></p>
                                    <hr/>
                                    <h4>Why is drinking water important?</h4>
                                    <p style="text-align: justify">Around of 70% of the body is comprised of water, and around of 71% of the planet's surface is covered by water. Perhaps it is the ubiquitous nature of water that means that drinking enough of it each day is not at the top of many people's lists of healthy priorities?
                                        One part of the body that relies on adequate water intake is the kidneys. The kidneys are organs that might not get as much attention as the heart or lungs, but they are responsible for many functions that help keep the body as healthy as possible</p>
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
                            <h1 style="text-align: center"> Weekly BMI:</h1>
                            <canvas id="bmiChart" height="90px" width="auto" style="padding-left: 10px"></canvas>
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
                                            data: [21, 21, 21, 22, 22, 23, 23]
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
                                <p style="font-style: italic; text-align: center">"You can only fail if you QUIT!"<small> - Unknown</small></p>
                                <hr/>
                                <h4>What is BMI?</h4>
                                <p style="text-align: justify">BMI stands for Body Mass Index. It is a measure of body composition. BMI is calculated by taking a person's weight and dividing by their height squared. The higher the figure the more overweight you are. Like any of these types of measures it is only an indication and other issues such as body type and shape have a bearing as well.</p>
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
                            <h1 style="text-align: center">Number of daily activities:</h1>
                            <canvas id="radarChart" height="90px" width="auto" style="padding-left: 10px"></canvas>
                            <script>
                                var radarData = {
                                    labels: ["Running", "Cycling", "Swimming", "Kickbox", "Virgin Active"],
                                    datasets: [
                                        {
                                            label: "My First dataset",
                                            fillColor: "rgba(220,220,220,0.2)",
                                            strokeColor: "#FF9500",
                                            pointColor: "#FF9500",
                                            pointStrokeColor: "#FF9500",
                                            pointHighlightFill: "#fff",
                                            pointHighlightStroke: "rgba(220,220,220,1)",
                                            data: [2, 1, 1, 1, 1]
                                        }
                                    ]
                                };

                                var radarOptions = {
                                    scaleShowLine: true,
                                    angleShowLineOut: true,
                                    scaleShowLabels: false,
                                    scaleBeginAtZero: true,
                                    angleLineColor: "#1DC7EA",
                                    angleLineWidth: 1,
                                    pointLabelFontFamily: "'Arial'",
                                    pointLabelFontStyle: "normal",
                                    pointLabelFontSize: 10,
                                    pointLabelFontColor: "#FF9500",
                                    pointDot: true,
                                    pointDotRadius: 3,
                                    pointDotStrokeWidth: 1,
                                    pointHitDetectionRadius: 20,
                                    datasetStroke: true,
                                    datasetStrokeWidth: 2,
                                    datasetFill: true,
                                    responsive: true,
                                };

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
                                <p style="font-style: italic; text-align: center">"The activity you're most avoiding contains your biggest opportunity."<small> - Robin Sharma</small></p>
                                <hr/>
                                <h4>Physical activity - it's important!</h4>
                                <p>Physical activity or exercise can improve your health and reduce the risk of developing several diseases like type 2 diabetes, cancer and cardiovascular disease. Physical activity and exercise can have immediate and long-term health benefits. Most importantly, regular activity can improve your quality of life. A minimum of 30 minutes a day can allow you to enjoy these benefits. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             </div>
            <!-- Row 2 End-->
    </div>
</div> <!-- content end-->

<!-- CONTENT END -->
<?php include __DIR__."/include/footer.php"; ?>
<?php include __DIR__."/include/closeHTML.php"; ?>

