
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
                        <h3 class="card-title">All Products</h3>
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
                                        <th>User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $products = getAdminData('products');
                                    $i = 1;
                                    foreach($products as $product):
                                    $userData = getProfile($product['user_id'])
                                    ?>
                                    <tr>
                                        <td><?php echo $i;$i++; ?></td>
                                        <td><a href="product-view.php?id=<?php echo $product['id'] ?>"><?php echo $product['product_name'] ?></a></td>
                                        <td><?php echo getProductCategoryName('category_name',$product['category_id']); ?></td>
                                        <td><img width="80" src="../uploads/products/<?php echo $product['photo'] ?>" alt="<?php echo $product['product_name'] ?>"></td>
                                        <td><?php echo date('d-m-Y',strtotime($product['created_at'])) ?></td>
                                        <td><a href="user-profile-view.php?id=<?php echo $product['user_id']?>"><?php echo $userData['name'] ?></a></td>
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