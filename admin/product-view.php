
<?php 

require_once('../config.php');
admin_header();
$id = $_REQUEST['id'];

$stm = $connection->prepare("SELECT * FROM products WHERE  id=?");
$stm->execute(array($id));
$result = $stm->fetch(PDO::FETCH_ASSOC);

?>

    <!--**********************************
        Content body start
    ***********************************-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3>Product Details</h3>
                            <hr>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><b>User Name :</b></td>
                                        <td><?php 
                                            $userData = getProfile($result['user_id']);
                                            echo $userData['name'];
                                        ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Product Name :</b></td>
                                        <td><?php echo $result['product_name']  ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Stock :</b></td>
                                        <td><?php echo $result['stock'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Description :</b></td>
                                        <td><?php echo $result['description'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>photo :</b></td>
                                        <td><img style="width: 200px; height:150px; object-fit:cover;" src="../uploads/products/<?php echo $result['photo'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Created Time:</b></td>
                                        <td><?php echo $result['created_at'] ?></td>
                                    </tr>
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