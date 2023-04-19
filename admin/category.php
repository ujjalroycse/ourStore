
<?php 

require_once('../config.php');

admin_header();



?>

    <!--**********************************
        Content body start
    ***********************************-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    
                    <div class="card-body">
                        <h3 class="card-title">All Category</h3>
                        <?php if(isset($_REQUEST['success'])) : ?>
                            <div class="alert alert-success">
                                <?php echo $_REQUEST['success']; ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Category Slug</th>
                                        <th>Date</th>
                                        <th>User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $categories = getAdminData('categories');
                                    $i = 1;
                                    foreach($categories as $category):
                                    $userData = getProfile($category['user_id'])
                                    ?>
                                    <tr>
                                        <td><?php echo $i;$i++; ?></td>
                                        <td><?php echo $category['category_name'] ?></td>
                                        <td><?php echo $category['category_slug'] ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($category['created_at'])) ?></td>
                                        <td><a href="user-profile-view.php?id=<?php echo $category['user_id'] ?>"><?php echo $userData['name'] ?></a></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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