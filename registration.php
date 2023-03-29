<?php require_once('config.php'); ?>
<?php 
session_start();
if(isset($_POST['registration_from'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $business_name = $_POST['business_name'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $password = $_POST['password'];

    $usernameCount = InputCount('username',$username);
    $emailCount = InputCount('email',$email);
    $mobileCount = InputCount('mobile',$mobile);

    if(empty($name)){
        $error = "Name is Required!";
    }
    elseif(empty($username)){
        $error = "User name is Required!";
    }
    elseif($usernameCount != 0){
        $error = "User name already used!";
    }
    elseif(empty($email)){
        $error = "Email is Required!";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Invalid Email!";
    }
    elseif($emailCount != 0){
        $error = "Email already used!";
    }
    elseif(empty($mobile)){
        $error = "Mobile Number is Required!";
    }
    elseif($mobileCount != 0){
        $error = "Mobile Number already used!";
    }
    elseif(empty($password)){
        $error = "Password is Required!";
    }
    else{
        $password = SHA1($password);
        $email_code = rand(111111,999999);
        $mobile_code = rand(111111,999999);
        $created_at = date('Y-m-d H:i:s');
        $username = strtolower($username);

        $insert = $connection->prepare("INSERT INTO users(name,username,email,mobile,password,business_name,address,gender,date_of_birth,status,email_code,mobile_code,created_at) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)" );
        $insert->execute(array($name,$username,$email,$mobile,$password,$business_name,$address,$gender,$date_of_birth,"Pending",$email_code,$mobile_code,$created_at));

        if($insert == true){
            $success = "User registration success!";

            //Verification code send
            $message = "Your verification code is ".$email_code;
            mail($email,"Email verification",$message);

            $_SESSION['user_email'] = $email;
            $_SESSION['user_mobile'] = $mobile;

            header('location:verification.php');
        }
        else{
            $error = "registration Failed!";
        }
    }


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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
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
                                <a class="text-center" href="registration.php"> <h2>Registration</h2></a>
                                <?php if(isset($error)) : ?>
                                    <div class="alert alert-danger">
                                        <?php echo $error; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if(isset($success)) : ?>
                                    <div class="alert alert-success">
                                        <?php echo $success; ?>
                                    </div>
                                <?php endif; ?>
        
                                <form action="" method="POST" class="mt-5 mb-5 login-input">
                                    <div class="form-group">
                                        <input type="text" name="name"n class="form-control"  placeholder="Name" >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control"  placeholder="User Name" >
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control"  placeholder="Email" >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="mobile" class="form-control"  placeholder="Mobile Number" >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="business_name" class="form-control"  placeholder="Business Name" >
                                    </div>
                                    <div class="form-group">
                                          <textarea class="form-control" name="address" placeholder="Address"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label><br>
                                        <label><input type="radio" checked name="gender" value="Male">Male</label><br>
                                        <label><input type="radio" name="gender" value="Female">Female</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="date" name="date_of_birth" class="form-control" placeholder="Date Of Birth" >
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password" >
                                    </div>
                                    <button type="submit" name="registration_from" class="btn login-form__btn submit w-100">Registration</button>
                                </form>
                                </div>
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





