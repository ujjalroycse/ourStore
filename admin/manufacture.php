
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
                        <h3 class="card-title">All Manufacture</h3>
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
                                        <th>Manufacture Name</th>
                                        <th>Address</th>
                                        <th>mobile</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $manufactures = getAdminData('manufacture');
                                    $i = 1;
                                    foreach($manufactures as $manufacture):
                                        $userData = getProfile($manufacture['user_id']);
                                    ?>
                                    <tr>
                                        <td><?php echo $i;$i++; ?></td>
                                        <td><?php echo $manufacture['name'] ?></td>
                                        <td><?php echo $manufacture['address']; ?></td>
                                        <td><?php echo $manufacture['mobile'] ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($manufacture['created_at'])) ?></td>
                                        <td><?php echo $userData['name'] ?></td>
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