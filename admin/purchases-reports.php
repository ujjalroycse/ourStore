
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
                        <h3 class="card-title">All Sales</h3>
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
                                        <th>Manufacture Name</th>
                                        <th>Group Name</th>
                                        <th>Expire Date</th>
                                        <th>Quantity</th>
                                        <th>Sub Total</th>
                                        <th>Date</th>
                                        <th>User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $sales = getAdminData('sales');
                                    $i = 1;
                                    foreach($sales as $sale):
                                        $userData = getProfile($sale['user_id'])
                                    ?>
                                    <tr>
                                        <td><?php echo $i;$i++; ?></td>
                                        <td><a href="sale-view.php?id=<?php echo $sale['user_id'] ?>"><?php echo getPurchasesData('products','product_name',$sale['product_id']); ?></a></td>
                                        <td><?php echo getPurchasesData('manufacture','name',$sale['manufacture_id']); ?></td>
                                        <td><?php echo getPurchasesData('groups','group_name',$sale['group_name']) ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($sale['expire_date'])) ?></td>
                                        <td><?php echo $sale['quantity'] ?></td>
                                        <td><?php echo $sale['total_price'] ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($sale['created_at'])) ?></td>
                                        <td><a href="user-profile-view.php?id=<?php echo $sale['user_id']?>"><?php echo $userData['name'] ?></a></td>
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