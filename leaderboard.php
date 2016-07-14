<?php
require_once("/ajax/jqSajax.class.php");
$title = "BitHealth | BMI";
session_start();
?>

<?php include __DIR__."/include/openHTML.php"; ?>
<?php include __DIR__."/include/navigation.php"; ?>
<!-- Content here-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="title">Leaderboard</h1>
                            <p class="category">The <strong>Top Ten</strong> users with the highest points:</p>
                        </div>
                        <!-- ***************Table data here -->
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                <th>Place:</th>
                                <th>Username:</th>
                                <th>Points:</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>MDaSilva</td>
                                    <td>1050</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>DrVanWyk</td>
                                    <td>850</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>KMAlex93</td>
                                    <td>800</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>AshBurnCrash</td>
                                    <td>750</td>

                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Oosthizen</td>
                                    <td>600</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>JonSnow</td>
                                    <td>500</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>JohnDoe01</td>
                                    <td>450</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Qw3rty</td>
                                    <td>400</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>beast101</td>
                                    <td>350</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>hpmanic</td>
                                    <td>300</td>
                                </tr>
                                </tbody>
                            </table>
                        </div> <!--content table end-->
                    </div> <!--card end-->
                </div> <!--col end-->
            </div> <!-- row end-->
        </div>
    </div>

<!-- End Content-->
<?php include __DIR__."/include/footer.php"; ?>
<?php include __DIR__."/include/closeHTML.php"; ?>