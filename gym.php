<?php /*global variables here*/
    $title = "BitHealth | ACTIVITY";
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
						<p class="category">Here is graph of your activity</p>
					</div>
<!--****************chart data here-->
					<div class="content">
						<div class="ct-major-twelfth">
							<canvas id="activityChart" height="100px"></canvas>
							<script type="text/javascript">
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
			            <p class="category">Here is table of your activity</p>
			        </div>
<!-- ***************Table data here -->
        			<div class="content table-responsive table-full-width">
			            <table class="table table-hover table-striped">
			                <thead>
			                    <th>ID</th>
			                	<th>Activity Type</th>
			                	<th>Location</th>
			                	<th>Date</th>
			                	<th>Duration (hr)</th>
			                </thead>
			                <tbody>
			                    <tr>
			                    	<td>1</td>
			                    	<td>Running</td>
			                    	<td>Sandton</td>
			                    	<td>Sat Jul 09 2016</td>
			                    	<td>1</td>
			                    </tr>
			                    <tr>
			                    	<td>2</td>
			                    	<td>Yoga</td>
			                    	<td>Sandton</td>
			                    	<td>Sat Jul 02 2016</td>
			                    	<td>1.5</td>
			                    </tr>
			                    <tr>
			                    	<td>3</td>
			                    	<td>Weighing</td>
			                    	<td>Waterfall</td>
			                    	<td>Sat Jun 25 2016</td>
			                    	<td>0.5</td>
			                    </tr>
			                    <tr>
			                    	<td>4</td>
			                    	<td>Running</td>
			                    	<td>Waterfall</td>
			                    	<td>Sat Jun 18 2016</td>
			                    	<td>2</td>
			                    </tr>
			                    <tr>
			                    	<td>5</td>
			                    	<td>Pilates</td>
			                    	<td>Waterfall</td>
			                    	<td>Sat Jun 11 2016</td>
			                    	<td>1</td>
			                    </tr>
			                    <tr>
			                    	<td>6</td>
			                    	<td>Running</td>
			                    	<td>Vodacom HQ</td>
			                    	<td>Sat Jun 04 2016</td>
			                    	<td>2</td>
			                    </tr>
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
