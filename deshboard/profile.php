

<?php 
require_once('../config.php');
require_once('../includes/header.php');
// get_header();
$profile = getProfile($_SESSION['user']['id']);


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
                                    <img class="mr-3" src="images/<?php echo $profile['photo']; ?>" width="80" height="80" style="object-fit: cover; border-radius:50%;" alt="">
                                    <?php else : ?>
                                    <img class="mr-3" src="../images/avatar/1.jpg" width="80" height="80"  alt="">
                                    <?php endif; ?>

                                    <div class="media-body">
                                        <h3 class="mb-1"><?php echo $profile['name'] ?></h3>
                                        <p class="text-muted mb-0"><?php echo $profile['username'] ?></p>
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
                                    <div class="col-12 text-center">
                                        <p>Profile Status : 
                                        <?php if($profile['status'] == "Active" ) : ?> 
                                            <span class="badge badge-success" >Active</span>
                                        <?php elseif($profile['status'] == "Pending" ) : ?> 
                                            <span class="badge badge-warning" >Pending</span>
                                        <?php elseif($profile['status'] == "Blocked" ) : ?> 
                                            <span class="badge badge-danger" >Blocked</span>
                                        <?php endif; ?>
                                        </p>
                                    </div>
                                </div>

                                <h4>About Me</h4>

                                <ul class="card-profile__info">
                                    <li class="mb-1"><strong class="text-dark mr-4">Mobile :</strong> <span><?php echo $profile['mobile']; ?></span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Email :</strong> <span><?php echo $profile['email'] ?></span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Business Name :</strong> <span><?php echo $profile['business_name'] ?></span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Gender :</strong> <span><?php echo $profile['gender'] ?></span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Birthday :</strong> <span><?php echo $profile['date_of_birth'] ?></span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Address :</strong> <span><?php echo $profile['address'] ?></span></li>
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
get_footer(); 

// require_once('includes/footer.php');
?>