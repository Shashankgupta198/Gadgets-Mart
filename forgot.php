<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <h1> Forgot Password </h1>
            </div>
            <form id="myform" method="post" action="resetpassword.php">
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="username"> Enter User Name: </label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="username" id="username">
                    </div>        
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="sq"> Choose Security Question : </label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-control" name="sq" id="sq">
                            <option value="">Choose Security Question</option>
                            <option value="name">what is your name?</option>
                            <option value="what is your first name?">what is your first name?</option>
                            <option value="what is your last name?">what is your last name?</option>
                            <option value="what is your first hero name?">what is your hero name?</option>
                        </select>
                    </div>        
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="sans"> Enter Security Answer : </label>
                    </div>
                    <div class="col-md-10">
                        <input type="password" class="form-control" name="sans" id="sans">
                    </div>        
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-block"  type="submit">Reset Password</button>
                    </div>
                </div>
            </form>
            <br>
            <?php
            if (isset($_SESSION["message"])) {
                $alert_class_name = "alert-success";
                if (isset($_SESSION["error"])) {
                    unset($_SESSION["error"]);
                    $alert_class_name = "alert-danger";
                }
                ?>
                <div class="alert <?php echo $alert_class_name; ?>">
                    <?php
                    echo $_SESSION["message"];
                    ?>
                </div>
                <?php
                unset($_SESSION["message"]);
            }
            ?>
        </div>

        <script src = "js/jquery.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
