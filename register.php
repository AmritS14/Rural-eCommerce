<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="login/images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="login/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="login/css/util.css">
    <link rel="stylesheet" type="text/css" href="login/css/main.css">
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-color: white;">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54" style="box-shadow: rgba(100, 100, 111, 0.5) 0px 7px 29px 0px;">
            <form class="login100-form validate-form" action="processRegister.php" method="post">
                <span class="login100-form-title p-b-49">
                    Register
                </span>

                <div class="wrap-input100 validate-input m-b-23" data-validate="Name is required">
                    <span class="label-input100">Full Name</span>
                    <input class="input100" type="text" name="name" placeholder="" required>
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23" data-validate="Email is required">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="email" name="email" placeholder="" required>
                    <span class="focus-input100" data-symbol="&#x2709;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23" data-validate="Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="password" placeholder="" required>
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Register as</span>
                    <select class="input100" name="role" required>
                        <option value="customer">Customer</option>
                        <option value="seller">Seller</option>
                    </select>
                    <span class="focus-input100" data-symbol="&#xf0c0;"></span>
                </div>

                <small class="form-text text-muted text-center mt-3">
                    Already have an account? <a href="login.php">Login here</a>
                </small>

                <div class="container-login100-form-btn" style="padding-top: 20px;">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="dropDownSelect1"></div>

<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="login/vendor/animsition/js/animsition.min.js"></script>
<script src="login/vendor/bootstrap/js/popper.js"></script>
<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="login/vendor/select2/select2.min.js"></script>
<script src="login/vendor/daterangepicker/moment.min.js"></script>
<script src="login/vendor/daterangepicker/daterangepicker.js"></script>
<script src="login/vendor/countdowntime/countdowntime.js"></script>
<script src="login/js/main.js"></script>

</body>
</html>