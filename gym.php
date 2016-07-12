<?php /*global variables here*/
require_once("ajax/jqSajax.class.php");
session_start();
$title = "BitHealth | ACTIVITY";
//GetAllActivities
	if (isset($_SESSION['Login'])) {

        $user = json_decode($_SESSION['user']);

		$url = "http://discotestcloud.cloudapp.net/Service1.svc/GetAllActivitys";
		$client = curl_init($url);
	    curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
	    $activity = curl_exec($client);
	    curl_close($client);

	    $text = json_decode($activity);
	    $tamp = $text->GetAllActivitysResult;
		$out = json_decode($tamp);

	}
	else{
		exit();
	}

?>

<?php include __DIR__."/include/openHTML.php"; ?>
<?php include __DIR__."/include/navigation.php"; ?>
<!-- CONTENT BEGIN -->
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Activity Graph</h4>
						<p class="category">Here is graph of all your activities per week</p>
					</div>
<!--****************chart data here-->

					<div class="content">
						<div class="ct-major-twelfth">
							<canvas id="activityChart" height="100px"></canvas>
							<script type="text/javascript">
								var lineData = {
									labels: ["Week 1", "Week 2", "Week 3", "Week 4", "Week 5", "Week 6", "Week 7"],
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


								var ctx = document.getElementById("activityChart").getContext("2d");
								var myNewChart = new Chart(ctx).Line(lineData, lineOptions);
							</script>
						</div>
					</div>
				</div> <!--card end-->
			</div> <!--col end-->
		</div> <!--row end-->

		<div class="row">
			<div class="col-md-12">
    			<div class="card">
			        <div class="header">
			            <h4 class="title">Activity Table</h4>
			            <p class="category">Here is table of all your activities</p>
			        </div>
<!-- ***************Table data here -->
        			<div class="content table-responsive table-full-width">
			            <table class="table table-hover table-striped">
			                <thead>
			                    <th>ID</th>
			                	<th>Activity Type</th>
			                	<th>Description</th>
			                	<th>Date</th>
			                </thead>
			                <tbody>
			                <?php 
			                	for($i = 0; $i < sizeof($out); $i++){
			                		echo '<tr>';
				                    echo '<td>' .$out[$i]->Id .'</td>';
				                    echo '<td>' .$out[$i]->Type .'</td>';
				                    echo '<td>' .$out[$i]->Discription .'</td>';
				                    echo '<td>' .$out[$i]->Date .'</td>';
			                    	echo '</tr>';
			                	};
			                ?>
			                </tbody>
			            </table>
			        </div> <!--content table end-->
        		</div> <!--card end-->
    		</div> <!--col end-->
		</div> <!-- row end-->
	</div> <!-- container-fluid end-->
</div> <!-- content end-->

<!-- CONTENT END -->
<?php include __DIR__."/include/footer.php"; ?>
<?php include __DIR__."/include/closeHTML.php"; ?>
