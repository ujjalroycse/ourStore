
<?php 

require_once('../config.php');
get_header();
$id = $_REQUEST['id'];
$user_id = $_SESSION['user']['id'];

if(isset($_POST['update_form'])){

    $product_id = $_POST['product_id'];
    $manufacture_id = $_POST['manufacture_id'];
    $group_name = $_POST['group_name'];
    $price = $_POST['price'];
    $manufacture_price = $_POST['manufacture_price'];
    $quantity = $_POST['quantity'];
    $expire_date = $_POST['expire_date'];

    if(empty($group_name)){
        $error = "Group name is required!";
    }
    elseif(empty($price)){
        $error = "Price is required!";
    }
    elseif(empty($manufacture_price)){
        $error = "Manufacture price is required!";
    }
    elseif(empty($quantity)){
        $error = "Quantity price is required!";
    }
    elseif(empty($expire_date)){
        $error = "Expire date is required!";
    }
    else{
        // $date = date('Y-m-d H:i:s');
        $statement=$connection->prepare("UPDATE purchases SET group_name=?,product_id=?,manufacture_id=?,quantity=?,price_item=?,manufacture_price_item=? WHERE user_id=? AND id=?");
        $statement->execute(array($group_name,$product_id,$manufacture_id,$quantity,$price,$manufacture_price,$user_id,$id));

        $success = "Purchase update successfully!";
    }
}

?>

<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 offset-md-1">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Update Purchase</h3>
                    <?php if(isset($error)) : ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    <?php if(isset($success)) : ?>
                        <div class="alert alert-success">
                            <?php echo $success; ?>
                        </div>
                    <?php endif; ?>

                    <hr>
                    <div class="basic-form">
                        <form action="" method="POST">
                            <?php 
                            $update_par_data = getSingleData('purchases',$id);
                            ?>
                            <div class="form-group">
                                <label for="product_id">Select Product :</label>
                                <select name="product_id" id="product_id" class="form-control input-default">
                                    <?php 
                                    $products = getTableData('products');
                                    
                                    foreach($products as $product): ?>
                                    <option value="<?php echo $product['id'] ?>"
                                    <?php 
                                    if($product['id'] == $update_par_data['product_id']){
                                        echo "selected";
                                    }
                                    ?>
                                    ><?php echo $product['product_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="manufacture_id">Select Manufacture :</label>
                                <select name="manufacture_id" id="manufacture_id" class="form-control input-default">
                                    <?php 
                                    $manufactures = getTableData('manufacture');
                                    foreach($manufactures as $manufacture): ?>
                                    <option value="<?php echo $manufacture['id'] ?>"
                                    <?php 
                                    if($manufacture['id'] == $update_par_data['manufacture_id']){
                                        echo "selected";
                                    }
                                    ?>
                                    ><?php echo $manufacture['name'].' - '.$manufacture['mobile']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="group_name">Group Name :</label>
                                <input id="group_name" type="text" name="group_name" value="<?php echo $update_par_data['group_name'] ?>" class="form-control input-default" >
                            </div>
                            <div class="form-group">
                                <label for="price">Price :</label>
                                <input type="text" name="price" id="price" value="<?php echo $update_par_data['price_item'] ?>" class="form-control input-default" >
                            </div>
                            <div class="form-group">
                                <label for="manufacture_price">Manufacture Price :</label>
                                <input type="text" name="manufacture_price" id="manufacture_price" value="<?php echo $update_par_data['manufacture_price_item'] ?>" class="form-control input-default">
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity :</label>
                                <input type="text" name="quantity" id="quantity" class="form-control input-default" value="<?php echo $update_par_data['quantity'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="update_form" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>
<!-- #/ container -->
    
<?php 
get_footer(); 
?>