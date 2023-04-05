
<?php 

require_once('../config.php');
require_once('../includes/header.php');
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
                                        <th>Manufacture</th>
                                        <th>Group</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $purchases = getTableData('purchases');
                                    $i = 1;
                                    foreach($purchases as $purchase):
                                    ?>
                                    <tr>
                                        <td><?php echo $i;$i++; ?></td>
                                        <td><?php echo getPurchasesData('products','product_name',$purchase['product_id']); ?></td>
                                        <td><?php echo getPurchasesData('manufacture','name',$purchase['manufacture_id']); ?></td>
                                        <td><?php echo $purchase['group_name'] ?></td>
                                        <td><?php echo $purchase['quantity'] ?></td>
                                        <td><?php echo $purchase['total_price'] ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($purchase['created_at'])) ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="view.php?id=<?php echo  $purchase['id'];?>"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success" href="edit-purchase.php?id=<?php echo  $purchase['id'];?>"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?') " href="delete-purchase.php?id=<?php echo  $purchase['id'];?>"><i class="fa fa-trash"></i></a>
                                        </td>
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
get_footer(); 
// require_once('../includes/footer.php');
?>