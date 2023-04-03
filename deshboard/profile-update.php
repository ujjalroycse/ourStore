<?php 
require_once('../config.php'); 
require_once('../includes/header.php'); 

$id = $_SESSION['user']['id'];
if(isset($_POST['profile_update_from'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $business_name = $_POST['business_name'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $photo = $_FILES['photo'];

    $usernameCount = InputCount('username',$username);
    $target_directory = "images/";
    $target_file = $target_directory . basename($_FILES["photo"]["name"]);
    $photoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(empty($name)){
        $error = "Name is Required!";
    }
    elseif(empty($username)){
        $error = "User name is Required!";
    }
    elseif($usernameCount != 0){
        $error = "User name already used!";
    }
    else{
        $created_at = date('Y-m-d H:i:s');
        $username = strtolower($username);

        $new_photo_name = $id." - ".rand(1111,9999)."-".time()."." .$photoFileType;
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_directory.$new_photo_name);

        $statement = $connection->prepare("UPDATE users SET name=?,username=?,business_name=?,address=?,gender=?,date_of_birth=?,photo=? WHERE id=?");
        $result = $statement->execute(array($name,$username,$business_name,$address,$gender,$date_of_birth,$new_photo_name,$id));

        if($result == true){
            $success = "Data update successfully!";
        }
        else{
            $error = "Update Failed!";
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
            <div class="col-xl-7">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-5">
                            <a class="text-center" href="profile-update.php"> <h2>Update</h2></a>
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
    
                            <form action="" method="POST" class="mt-5 mb-5 login-input" enctype="multipart/form-data">
                                <?php 
                                $update_data = getProfile($id);
                                ?>
                                <div class="form-group">
                                    <label for="name">Name :</label>
                                    <input type="text" id="name" name="name" class="form-control input-default" value="<?php echo $update_data['name']; ?>"  placeholder="Name" >
                                </div>
                                <div class="form-group">
                                    <label for="username">User Name :</label>
                                    <input type="text" id="username" name="username" class="form-control input-default" value="<?php echo $update_data['username']; ?>" placeholder="User Name" >
                                </div>
                                <div class="form-group">
                                    <label for="business_name">Business Name :</label>
                                    <input type="text" id="business_name" name="business_name" class="form-control input-default" value="<?php echo $update_data['business_name']; ?>" placeholder="Business Name" >
                                </div>
                                <div class="form-group">
                                    <label for="address">Address :</label>
                                    <textarea class="form-control input-default" id="address" name="address" placeholder="Address"><?php echo $update_data['address']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Gender</label><br>
                                    <label><input type="radio" checked name="gender" value="Male">Male</label><br>
                                    <label><input type="radio" name="gender" value="Female">Female</label>
                                </div>
                                <div class="form-group">
                                    <label for="date_of_birth">Date Of Birth :</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo $update_data['date_of_birth']; ?>" class="form-control input-default" placeholder="Date Of Birth" >
                                </div>
                                <div class="form-group">
                                    <label for="photo">Photo :</label>
                                    <input type="file" id="photo" name="photo" class="form-control input-default"  >
                                </div>
                                <button type="submit" name="profile_update_from" class="btn login-form__btn submit w-100">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>





