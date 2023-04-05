
<?php 

require_once('../config.php');
require_once('../includes/header.php');
$id = $_REQUEST['id'];
$user_id = $_SESSION['user']['id'];

$statement = $connection->prepare("SELECT * FROM groups WHERE user_id=? AND id=?");
$statement->execute(array($user_id,$id));
$view = $statement->fetch(PDO::FETCH_ASSOC);

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
                            <h3>Purchase Details</h3>
                            <hr>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><b>Product Name :</b></td>
                                        <td><?php echo getPurchasesData('products','product_name',$view['product_id'])  ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Group Name :</b></td>
                                        <td><?php echo $view['group_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Expire Date :</b></td>
                                        <td><?php 
                                        $expire_date = getGroupData('expire_date',$view['group_name'],$view['product_id']);
                                        echo date('d-m-Y', strtotime($expire_date));
                                        ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Quantity :</b></td>
                                        <td><?php echo $view['quantity'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Price Item :</b></td>
                                        <td><?php echo $view['price_item'] ?> TK</td>
                                    </tr>
                                    <tr>
                                        <td><b>Manufacture Price Item :</b></td>
                                        <td><?php echo $view['manufacture_price_item'] ?> TK</td>
                                    </tr>
                                    <tr>
                                        <td><b>Total Price :</b></td>
                                        <td><?php echo $view['total_price'] ?> TK</td>
                                    </tr>
                                    <tr>
                                        <td><b>Total Manufacture Price :</b></td>
                                        <td><?php echo $view['total_manufacture_price'] ?> TK</td>
                                    </tr>
                                    <tr>
                                        <td><b>Created Time:</b></td>
                                        <td><?php echo $view['created_at'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-right">
                                <a class="btn btn-success" href="index.php">See all</a>
                            </div>
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