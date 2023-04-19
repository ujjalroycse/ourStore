
<?php 

require_once('../config.php');
admin_header();
$id = $_SESSION['user']['id'];

?>

    <!--**********************************
        Content body start
    ***********************************-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    
                    <div class="card-body">
                        <h3 class="card-title">Groups</h3>
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
                                        <th>Product Name</th>
                                        <th>Group</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Date</th>
                                        <th>Expire Date</th>
                                        <th>User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $groups = getAdminData('groups');
                                    $i = 1;
                                    foreach($groups as $group):
                                        $userData = getProfile($group['user_id'])
                                    ?>
                                    <tr>
                                        <td><?php echo $i;$i++; ?></td>
                                        <td><?php echo getPurchasesData('products','product_name',$group['product_id']); ?></td>
                                        <td><?php echo $group['group_name'] ?></td>
                                        <td><?php echo $group['quantity'] ?></td>
                                        <td><?php echo $group['total_price'] ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($group['created_at'])) ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($group['expire_date'])) ?></td>
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