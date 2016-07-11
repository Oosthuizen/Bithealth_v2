<?php
require_once("/ajax/jqSajax.class.php");
session_start();

function DoLogin($username,$Password){
    //for later
    $url = "http://localhost:53172/Surf.svc/Login/$username/$Password";
    $client = curl_init($url);
    $data = "username=$username&pwd=$Password";

    curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($client,CURLOPT_POST,1);
    curl_setopt($client,CURLOPT_POSTFIELDS,$data);

    $response = curl_exec($client);
    curl_close($client);
    $result = json_decode($response);

    $_SESSION['Login'] = true;
    $_SESSION['user'] = $result;
    return 1;
}

//-----------------------------------------------------------
$ajax = new jqSajax(1, 1, 1); //the default jqSajax(1,1,1)
$ajax->request_type = "POST";
//$ajax->debug_mode = 1;
$ajax->friendly_url = 1;
$ajax->as_method = 1;
$ajax->export("page->DoLogin", "DoLogin");
$ajax->processClientReq();
//-----------------------------------------------------------

?>
</head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BitHealth | Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">


    <link href="assets/css/login-register.css" rel="stylesheet">
    <link href="assets/css/login-css.css" rel="stylesheet">

    <script src="assets/js/login-register.js"></script>
    <script src="ajax/jquery.validate.min.js"></script>

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Login validation -->
    <script src="js/plugins/ValidationFormScript.js"></script>

</head>
    <body class="login-background">
    <div class="card login-block">
        <div class="card-block">
                <image alt="logo" src="assets/img/logo.png" style="max-width: 50%; height: auto" id="img-logo"></image>
                <h3>Welcome to Bithealth! :)</h3>
                <form role="form" id="form1">
                    <div class="form-group" style="max-width: 350px; margin-left: 17.5px;">
                        <input id="Email" name="email" type="text" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group" style="max-width: 350px; margin-left: 17.5px;">
                        <input id="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <button id="Submit" type="button" class="btn btn-primary block" style="margin-bottom: 10px; background-color: #FFFFFF">Login</button>
                </form>
        </div>
    </div>


        <!-- Mainly scripts -->
        <script src="assets/js/jquery-2.1.1.js"></script>


    <!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>

        <script type="text/javascript">
            <?php
            //Prints the js required for the functions/methods created in php.
            $ajax->showJs();
            ?>
            $("#Submit").click(function() {
                var email = $('#Email').val();
                var password = $('#password').val();
                var result = ($.x_DoLogin(email,password));
                if (result == "1"){
                    window.location.replace("dashboard.php");
                }
                else {
                    console.log(result);
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "onclick": null,
                        "showDuration": "400",
                        "hideDuration": "1000",
                        "timeOut": "7000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.error('with login','error!');
                }
            });
        </script>
    </body>

</html>
