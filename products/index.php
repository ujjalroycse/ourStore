
<?php 

require_once('../config.php');
require_once('../includes/header.php');



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
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Photo</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $products = getTableData('products');
                                    $i = 1;
                                    foreach($products as $product):
                                    ?>
                                    <tr>
                                        <td><?php echo $i;$i++; ?></td>
                                        <td><?php echo $product['product_name'] ?></td>
                                        <td><?php echo getProductCategoryName('category_name',$product['category_id']); ?></td>
                                        <td><img width="80" src="../uploads/products/<?php echo $product['photo'] ?>" alt="<?php echo $product['product_name'] ?>"></td>
                                        <td><?php echo date('d-m-Y',strtotime($product['created_at'])) ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="edit-products.php?id=<?php echo  $product['id'];?>"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?') " href="delete-products.php?id=<?php echo  $product['id'];?>"><i class="fa fa-trash"></i></a>
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