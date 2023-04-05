
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $groups = getTableData('groups');
                                    $i = 1;
                                    foreach($groups as $group):
                                    ?>
                                    <tr>
                                        <td><?php echo $i;$i++; ?></td>
                                        <td><?php echo getPurchasesData('products','product_name',$group['product_id']); ?></td>
                                        <td><?php echo $group['group_name'] ?></td>
                                        <td><?php echo $group['quantity'] ?></td>
                                        <td><?php echo $group['total_price'] ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($group['created_at'])) ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($group['expire_date'])) ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="view.php?id=<?php echo  $group['id'];?>"><i class="fa fa-eye"></i></a>
                                            <!-- <a class="btn btn-sm btn-success" href="edit-purchase.php?id=<?php //echo  $purchase['id'];?>"><i class="fa fa-edit"></i></a> -->
                                            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?') " href="delete.php?id=<?php echo  $group['id'];?>"><i class="fa fa-trash"></i></a>
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