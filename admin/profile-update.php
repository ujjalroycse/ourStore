<?php 
require_once('../config.php'); 
admin_header(); 

$id = $_SESSION['admin']['id'];

if(isset($_POST['profile_update_from'])){
    $username = $_POST['username'];
    $role = $_POST['role'];
    $photo = $_FILES['photo'];

    $usernameCount = InputAdminCount('username',$username);
    $target_directory = "../deshboard/images/";
    $target_file = $target_directory . basename($_FILES["photo"]["name"]);
    $photoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(empty($username)){
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

        $statement = $connection->prepare("UPDATE admins SET username=?,role=?,photo=? WHERE id=?");
        $result = $statement->execute(array($username,$role,$new_photo_name,$id));

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
                            <a class="text-center" href="profile-update.php"> <h2>Update Admin Profile</h2></a>
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
                                $update_data = adminProfile($id);
                                ?>
                                <div class="form-group">
                                    <label for="username">User Name :</label>
                                    <input type="text" id="username" name="username" class="form-control input-default" value="<?php echo $update_data['username']; ?>" placeholder="User Name" >
                                </div>
                                <div class="form-group">
                                    <label for="photo">Photo :</label>
                                    <input type="file" id="photo" name="photo" class="form-control input-default"  >
                                </div>
                                <div class="form-group">
                                    <label for="role">Role :</label>
                                    <input type="text" id="role" name="role" class="form-control input-default" value="<?php echo $update_data['role']; ?>" placeholder="User Name" >
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

<?php admin_footer(); ?>





