
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
                        <h3 class="card-title">All Purchase</h3>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Manufacture</th>
                                        <th>Group</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Date</th>
                                        <th>User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $purchases = getAdminData('purchases');
                                    $i = 1;
                                    foreach($purchases as $purchase):
                                        $userData = getProfile($purchase['user_id'])
                                    ?>
                                    <tr>
                                        <td><?php echo $i;$i++; ?></td>
                                        <td><?php echo getPurchasesData('products','product_name',$purchase['product_id']); ?></td>
                                        <td><?php echo getPurchasesData('manufacture','name',$purchase['manufacture_id']); ?></td>
                                        <td><?php echo $purchase['group_name'] ?></td>
                                        <td><?php echo $purchase['quantity'] ?></td>
                                        <td><?php echo $purchase['total_price'] ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($purchase['created_at'])) ?></td>
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