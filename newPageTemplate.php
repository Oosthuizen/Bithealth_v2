<?php /*global variables here*/
$title = "BitHealth | PROGRESS";
?>

<?php include __DIR__."/include/openHTML.php"; ?>
<?php include __DIR__."/include/navigation.php"; ?>
<!-- CONTENT BEGIN -->

<div class="content">
    <div class="container-fluid">
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
            <!-- Row 2-->
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

