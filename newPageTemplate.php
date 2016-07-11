<?php /*global variables here*/
$title = "BitHealth | PROGRESS";
?>

<?php include __DIR__."/include/openHTML.php"; ?>
<?php include __DIR__."/include/navigation.php"; ?>
<!-- CONTENT BEGIN -->

<div class="content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card-container">
                        <div class="card">
                            <div class="front">
                                <h1> Running </h1>
                                <br/>
                                <small>Running</small>
                                <canvas id="activityChart" height="100px"></canvas>
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
                            </div>
                            <div class="footer">
                                <i class="fa fa-mail-forward"></i>Auto Rotation
                            </div>
                        </div>
                    </div>
                </div>
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
    </div> <!-- container-fluid end-->
<?php include __DIR__."/include/footer.php"; ?>
</div> <!-- content end-->

<!-- CONTENT END -->
<?php include __DIR__."/include/closeHTML.php"; ?>

