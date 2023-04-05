
<?php 

require_once('../config.php');
require_once('../includes/header.php');
$user_id = $_SESSION['user']['id'];

if(isset($_POST['purchase_submit'])){

    $product_id = $_POST['product_id'];
    $manufacture_id = $_POST['manufacture_id'];
    $group_name = $_POST['group_name'];
    $price_item = $_POST['price'];
    $manufacture_price = $_POST['manufacture_price'];
    $quantity = $_POST['quantity'];
    $expire_date = $_POST['expire_date'];

    if(empty($group_name)){
        $error = "Group name is required!";
    }
    elseif(empty($price_item)){
        $error = "Price is required!";
    }
    elseif(!is_numeric($price_item)){
        $error = "Price money use only number!";
    }
    elseif(empty($manufacture_price)){
        $error = "Manufacture Price is required!";
    }
    elseif(!is_numeric($manufacture_price)){
        $error = "Manufacture Price use only number!";
    }
    elseif(empty($quantity)){
        $error = "Quantity is required!";
    }
    elseif(!is_numeric($quantity)){
        $error = "Quantity use only number!";
    }
    elseif(empty($expire_date)){
        $error = "Expire date is required!";
    }
    else{
        $date = date('Y-m-d H:i:s');
        $total_price = $price_item*$quantity;
        $total_manufacture_price = $manufacture_price*$quantity;

        // create groups
        $statement=$connection->prepare("INSERT INTO groups(user_id,group_name,product_id,quantity,price_item,manufacture_price_item,total_price,total_manufacture_price,expire_date,created_at) VALUES(?,?,?,?,?,?,?,?,?,?)");
        $statement->execute(array($user_id,$group_name,$product_id,$quantity,$price_item,$manufacture_price,$total_price,$total_manufacture_price,$expire_date,$date));

        // create purchases
        $statement=$connection->prepare("INSERT INTO purchases(user_id,group_name,manufacture_id,product_id,quantity,price_item,manufacture_price_item,total_price,total_manufacture_price,created_at) VALUES(?,?,?,?,?,?,?,?,?,?)");
        $statement->execute(array($user_id,$group_name,$manufacture_id,$product_id,$quantity,$price_item,$manufacture_price,$total_price,$total_manufacture_price,$date));
        

        $success = "Create successfully!";
    }
}

?>

<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 offset-md-1">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Create New Products</h3>
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
                        <form action="" method="POST" >
                            <div class="form-group">
                                <label for="product_id">Select Product :</label>
                                <select name="product_id" id="product_id" class="form-control input-default">
                                    <?php 
                                    $products = getTableData('products');
                                    
                                    foreach($products as $product): ?>
                                    <option value="<?php echo $product['id'] ?>"><?php echo $product['product_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="manufacture_id">Select Manufacture :</label>
                                <select name="manufacture_id" id="manufacture_id" class="form-control input-default">
                                    <?php 
                                    $manufactures = getTableData('manufacture');
                                    foreach($manufactures as $manufacture): ?>
                                    <option value="<?php echo $manufacture['id'] ?>"><?php echo $manufacture['name'].' - '.$manufacture['mobile']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="group_name">Group Name :</label>
                                <input id="group_name" type="text" name="group_name" class="form-control input-default" placeholder="Group Name">
                            </div>
                            <div class="form-group">
                                <label for="price">Price :</label>
                                <input type="text" name="price" id="price" class="form-control input-default" placeholder="Price">
                            </div>
                            <div class="form-group">
                                <label for="manufacture_price">Manufacture Price :</label>
                                <input type="text" name="manufacture_price" id="manufacture_price" class="form-control input-default" placeholder="Manufacture Price">
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity :</label>
                                <input type="text" name="quantity" id="quantity" class="form-control input-default" placeholder="Quantity">
                            </div>
                            <div class="form-group">
                                <label for="expire_date">Expire Date:</label>
                                <input type="date" name="expire_date" id="expire_date" class="form-control input-default" placeholder="Expire Date">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="purchase_submit" class="btn btn-primary" value="Purchase">
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