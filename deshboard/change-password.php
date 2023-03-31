

<?php 
require_once('../config.php');
get_header();
$profile = getProfile($_SESSION['user']['id']);
if(isset($_POST['change_password'])){
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $database_password = $profile['password'];
    $database_password_hash = SHA1($current_password);

    if(empty($current_password)){
        $error = "Current password is required!";
    }
    elseif(empty($new_password)){
        $error = "New password is required!";
    }
    elseif(empty($confirm_password)){
        $error = "Confirm password is required!";
    }
    elseif($new_password != $confirm_password){
        $error = "Don't match New password & Confirm password!";
    }
    elseif($database_password != $database_password_hash){
        $error = "Current password is wrong!";
    }
    else{
        $new_pass_hash = SHA1($confirm_password);
        $statement=$connection->prepare("UPDATE users SET password=? WHERE id=?");
        $statement->execute(array($new_pass_hash,$_SESSION['user']['id']));

        $success = "Change password successfully!";
    }
}

?>

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Change Password</h3>
                                <?php if(isset($error)) : ?>
                                    <div class="alert alert-danger">
                                        <?php echo $error; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if(isset($success)) : ?>
                                    <div class="alert alert-success">
                                        <?php echo $success; ?>
                                    </div>
                                <script>
                                    setTimeout(function(){
                                        window.location.href="../logout.php";
                                    },2000);
                                </script>
                                <?php endif; ?>

                                <hr>
                                <div class="basic-form">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                          <input type="password" name="current_password" class="form-control input-default" placeholder="Current Password">
                                        </div>
                                        <div class="form-group">
                                          <input type="password" name="new_password" class="form-control input-default" placeholder="New Password">
                                        </div>
                                        <div class="form-group">
                                          <input type="password" name="confirm_password" class="form-control input-default" placeholder="Confirm New Password">
                                        </div>
                                        <div class="form-group text-center">
                                          <input type="submit" name="change_password" class="btn btn-success" value="Change Password">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <!-- #/ container -->
    
<?php get_footer(); ?>