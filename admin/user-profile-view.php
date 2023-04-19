

<?php 
require_once('../config.php');
admin_header();

$id=$_REQUEST['id'];
$userData = getUserSingleData('users',$id);

?>

            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center mb-4">
                                    <?php if($userData['photo'] != NULL) : ?>
                                    <img class="mr-3" src="../deshboard/images/<?php echo $userData['photo']; ?>" width="80" height="80" style="object-fit: cover; border-radius:50%;" alt="">
                                    <?php else : ?>
                                    <img class="mr-3" src="../images/avatar/2.jpg" width="80" height="80" style="object-fit: cover; border-radius:50%;" alt="">
                                    <?php endif; ?>

                                    <div class="media-body">
                                        <h3 class="mb-1"><?php echo $userData['name'] ?></h3>
                                        <p class="text-muted mb-0"><?php echo $userData['username'] ?></p>
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
                                        <?php if($userData['status'] == "Active" ) : ?> 
                                            <span class="badge badge-success" >Active</span>
                                        <?php elseif($userData['status'] == "Pending" ) : ?> 
                                            <span class="badge badge-warning" >Pending</span>
                                        <?php elseif($userData['status'] == "Blocked" ) : ?> 
                                            <span class="badge badge-danger" >Blocked</span>
                                        <?php endif; ?>
                                        </p>
                                    </div>
                                </div>

                                <h4>About Me</h4>

                                <ul class="card-profile__info">
                                    <li class="mb-1"><strong class="text-dark mr-4">Mobile :</strong> <span><?php echo $userData['mobile']; ?></span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Email :</strong> <span><?php echo $userData['email'] ?></span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Business Name :</strong> <span><?php echo $userData['business_name'] ?></span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Gender :</strong> <span><?php echo $userData['gender'] ?></span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Birthday :</strong> <span><?php echo $userData['date_of_birth'] ?></span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Address :</strong> <span><?php echo $userData['address'] ?></span></li>
                                </ul>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <!-- #/ container -->
    
<?php 
admin_footer(); 
?>