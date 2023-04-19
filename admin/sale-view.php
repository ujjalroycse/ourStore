
<?php 

require_once('../config.php');
admin_header();
$id = $_REQUEST['id'];
$user_id = $_SESSION['user']['id'];

$statement = $connection->prepare("SELECT * FROM sales WHERE user_id=? AND id=?");
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
                            <h3>Sale Details</h3>
                            <hr>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><b>Customer Name :</b></td>
                                        <td><?php echo $view['customer_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Product Name :</b></td>
                                        <td><?php echo getPurchasesData('products','product_name',$view['product_id'])  ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Manufacture Name :</b></td>
                                        <td><?php echo getPurchasesData('manufacture','name',$view['manufacture_id']) ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Group Name :</b></td>
                                        <td><?php echo getPurchasesData('groups','group_name',$view['group_name']) ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Expire Date :</b></td>
                                        <td><?php 
                                        $expire_date = getSaleData('expire_date',$view['group_name'],$view['product_id']);
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
                                        <td><b>Discount :</b></td>
                                        <td><?php 
                                        if($view['discount_type'] == "fixed"){
                                            echo $view['discount_amount']." Tk";
                                        }
                                        else if($view['discount_type']=="percentage"){
                                            echo $view['discount_amount']." %";
                                        }
                                        else{
                                            echo "None";
                                        }
                                        ?> </td>
                                    </tr>
                                    <tr>
                                        <td><b>Sub Total :</b></td>
                                        <td><?php echo $view['sub_total'] ?> TK</td>
                                    </tr>
                                    <tr>
                                        <td><b>Created Time:</b></td>
                                        <td><?php echo date('d-m-Y H:i:s',strtotime($view['created_at'])) ?></td>
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