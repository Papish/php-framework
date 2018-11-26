<?php
session_start();
if(isset($_SESSION['logged_in']) AND $_SESSION['logged_in'] === TRUE) {
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DOJO LOGIN PANEL</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../assets/admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../assets/admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../assets/admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <style>
        #demo {
            height: auto;
            width: 100%;
            margin-bottom: -100px;
            margin-top: 10px;
            background-color: #F8F8F8;
        }
        img.display
        {   
            margin-left: auto;
            margin-right: auto;
            display: block;

        }
        /* Large desktops and laptops */
        @media (min-width: 1200px) {

        }

        /* Landscape tablets and medium desktops */
        @media (min-width: 992px) and (max-width: 1199px) {
            #demo {
                margin-bottom: -70px;
            }
        }

        /* Portrait tablets and small desktops */
        @media (min-width: 768px) and (max-width: 991px) {
            #demo {
                margin-bottom: -180px;
            }
        }

        /* Landscape phones and portrait tablets */
        @media (max-width: 767px) {
            #demo {
                margin-bottom: -120px;
            }
        }

        /* Portrait phones and smaller */
        @media (max-width: 480px) {
            #demo {
                margin-bottom: -70px;
            }
        }
        </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <div id="demo">
                <img class="display" src="../assets/images/2.jpg" alt="" width="200" height="200">
            </div>
            <br>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <?php
                            if(isset($_SESSION['login_error']) AND $_SESSION['login_error'] === TRUE) {
                                echo "Wrong login credentials. Try Again";
                            }
                            else {
                                echo "Enter your login credentials";
                            }
                            unset($_SESSION['field_empty']);
                            unset($_SESSION['login_error']);
                            ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="process/process_login.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" required placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="login" value="Login" class="btn btn-primary" style="width:100%; padding:10px;">
                                <div class="checkbox">
                                    Forgot password? <a href="#">Reset here</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../assets/admin/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../assets/admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../assets/admin/dist/js/sb-admin-2.js"></script>

</body>

</html>
