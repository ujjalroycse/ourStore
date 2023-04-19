

<?php 
require_once('../config.php');
admin_header();

$profile = getAdminProfile($_SESSION['admin']['id']);


?>

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center mb-4">
                                    <?php if($profile['photo'] != NULL) : ?>
                                    <img class="mr-3" src="../deshboard/images/<?php echo $profile['photo']; ?>" width="80" height="80" style="object-fit:cover;border-radius:50%;" alt="">
                                    <?php else : ?>
                                    <img class="mr-3" src="../images/avatar/1.jpg" width="80" height="80" style="object-fit:cover;border-radius:50%;" alt="">
                                    <?php endif; ?>

                                    <div class="media-body">
                                        <h3 class="mb-1"><?php echo $profile['username'] ?></h3>
                                        <p class="text-muted mb-0"><?php echo $profile['role'] ?></p>
                                    </div>
                                </div>
                                
                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="card card-profile text-center">
                                            <span class="mb-1 text-primary"><i class="icon-people"></i></span>
                                            <h3 class="mb-0">263</h3>
                                            <p class="text-muted px-4">Total Purchase</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card card-profile text-center">
                                            <span class="mb-1 text-warning"><i class="icon-user-follow"></i></span>
                                            <h3 class="mb-0">263</h3>
                                            <p class="text-muted">Total Sale</p>
                                        </div>
                                    </div>
                                </div>

                                <h4>About Admin</h4>

                                <ul class="card-profile__info">
                                    <li class="mb-1"><strong class="text-dark mr-4">User Name :</strong> <span><?php echo $profile['username']; ?></span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Role :</strong> <span><?php echo $profile['role'] ?></span></li>
                                </ul>
                                <br>
                                <div class="col-12 text-center">
                                        <a href="profile-update.php" class="btn btn-danger px-5">Update Profile</a>
                                        <br>
                                        <br>
                                        <a href="change-password.php" class="btn btn-warning text-white px-5">Change Password</a>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <!-- #/ container -->
    
<?php 
admin_footer(); 

?>