
<?php require_once('config.php'); ?>
<?php 
session_start();

if(isset($_POST['login_from'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if(empty($username)){
        $error = "User name is Required!";
    }
    elseif(empty($password)){
        $error = "Password is Required!";
    }
    else{
        $password = SHA1($password);

        $loginCount = $connection->prepare('SELECT id,name,username,email,mobile,email_status,mobile_status FROM users WHERE username=? AND password=?');
        $loginCount->execute(array($username,$password));
        $userloginCount = $loginCount->rowCount();
        if($userloginCount == 1){
            $userData = $loginCount->fetch(PDO::FETCH_ASSOC);

            if($userData['email_status'] == 1 AND $userData['mobile_status'] == 1 ){
                $_SESSION['user'] = $userData;
                header('location:'.GET_APP_URL().'/deshboard');
            }
            else{

                //User verification data
                $_SESSION['user_email'] = $userData['email'];
                $_SESSION['user_mobile'] = $userData['mobile'];

                $email_code = rand(111111,999999);
                $statement = $connection->prepare("UPDATE users SET email_code=? WHERE email=?");
                $statement->execute(array($email_code,$userData['email']));

                // $mobile_code = rand(111111,999999);
                // $statement = $connection->prepare("UPDATE users SET mobile_code=? WHERE mobile=?");
                // $statement->execute(array($mobile_code,$userData['mobile']));

                $message = "Your verification code is ".$email_code;
                mail($userData['email'],"Email verification",$message);

                header('location:verification.php');
            }
        }
        else{
            $error = "Username Or Password is Wrong!";
        }
    }
}
if(isset($_SESSION['user'])){
    header('location:'.GET_APP_URL().'/deshboard');
}


?>

<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Our Store</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="css/style.css" rel="stylesheet">
    
</head>

<body class="h-100">
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    



    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="login.php"> <h2>Login</h2></a>
                                <?php if(isset($error)) : ?>
                                    <div class="alert alert-danger">
                                        <?php echo $error; ?>
                                    </div>
                                <?php endif; ?>
        
                                <form action="" method="POST" class="mt-5 mb-5 login-input">
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control" placeholder="User Name ">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    <button name="login_from" class="btn login-form__btn submit w-100">Login</button>
                                </form>
                                <p class="mt-5 login-form__footer">Dont have account? <a href="registration.php" class="text-primary">Registration</a> now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
</body>
</html>





