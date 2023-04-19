
<?php 

require_once('../config.php');
require_once('../includes/header.php');
$user_id = $_SESSION['user']['id'];

if(isset($_POST['sale_submit'])){

    $customer_name = $_POST['customer_name'];
    $product_id = $_POST['product_id'];
    $manufacture_id = $_POST['manufacture_id'];
    $group_name = $_POST['group_name'];
    $price_item = $_POST['price_item'];
    $manufacture_price = $_POST['manufacture_price'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];
    $discount_type = $_POST['discount_type'];
    $discount_amount = $_POST['discount_amount'];
    $sub_total = $_POST['sub_total'];
    $expire_date = $_POST['expire_date'];

    $new_expire_date = getGroupDataById('expire_date',$group_name,$product_id);
    $new_product = getPurchasesData('products','stock',$product_id);

    if(empty($customer_name)){
        $error = "Customer name is required!";
    }
    elseif(empty($product_id)){
        $error = "Product id is required!";
    }
    elseif(empty($price_item)){
        $error = "Price item is required!";
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
    elseif($new_expire_date<date('d-m-Y')){
        $error = "Your product is required!";
    }
    elseif($quantity>$new_product){
        $error = "Product out of stock!";
    }
    else{
        $date = date('Y-m-d H:i:s');
        $total_price = $price_item*$quantity;
        $total_manufacture_price = $manufacture_price*$quantity;

        // create groups
        $statement=$connection->prepare("INSERT INTO sales(user_id,customer_name,product_id,manufacture_id,group_name,expire_date,price_item,manufacture_price_item,quantity,total_price,discount_type,discount_amount,sub_total,created_at) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute(array($user_id,$customer_name,$product_id,$manufacture_id,$group_name,$expire_date,$price_item,$manufacture_price,$quantity,$total_price,$discount_type,$discount_amount,$sub_total,$date));

        // create product
        $statement=$connection->prepare("UPDATE products SET stock=stock-? WHERE id=?");
        $statement->execute(array($quantity,$product_id));       
        

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

                    <div id="ajaxError" style="display: none;" class="alert alert-danger"></div>

                    <hr>
                    <div class="basic-form">
                        <form action="" method="POST" >
                            <div class="form-group">
                                <label for="customer_name">Customer Name :</label>
                                <input id="customer_name" type="text" name="customer_name" class="form-control input-default" placeholder="Customer Name">
                            </div>
                            <div class="form-group">
                                <label for="product_id">Select Product :</label>
                                <select name="product_id" id="product_id" class="form-control input-default">
                                    <option value="#">Select Product</option>
                                    <?php 
                                    $products = getTableData('products');
                                    foreach($products as $product): ?>
                                    <option value="<?php echo $product['id'] ?>"><?php echo $product['product_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="manufacture_name">Manufacture :</label>
                                <input type="text" name="manufacture_name" id="manufacture_name" class="form-control input-default" readonly>
                                <input type="hidden" name="manufacture_id" id="manufacture_id">
                            </div>
                            <div class="form-group">
                                <label for="group_name">Group Name :</label>
                                <select name="group_name" id="group_name" class="form-control input-default"></select>
                            </div>
                            <div class="form-group">
                                <label for="expire_date">Expire Date :</label>
                                <input type="text" name="expire_date" id="expire_date" class="form-control input-default" readonly>
                            </div>
                            <div class="form-group">
                                <label for="price_item">Price :</label>
                                <input type="text" name="price_item" id="price_item" class="form-control input-default" readonly>
                            </div>
                            <div class="form-group">
                                <label for="manufacture_price">Manufacture Price :</label>
                                <input type="text" name="manufacture_price" id="manufacture_price" class="form-control input-default" readonly>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity : <span id="avilable_stock" class="badge badge-primary"></span></label>
                                <input type="number" name="quantity" id="quantity" class="form-control input-default" placeholder="Quantity">
                                <input type="hidden" name="stock" id="stock">
                            </div>
                            <div class="form-group">
                                <label for="total_price">Total Price :</label>
                                <input type="text" name="total_price" id="total_price" class="form-control input-default" readonly>
                            </div>
                            <div class="form-group">
                                <label for="discount_type">Discount Type :</label>
                                <select name="discount_type" id="discount_type" class="form-control input-default">
                                    <option value="none">None</option>
                                    <option value="fixed">Fixed</option>
                                    <option value="percentage">Percentage</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="discount_amount">Discount Amount:</label>
                                <input type="text" name="discount_amount" id="discount_amount" class="form-control input-default">
                            </div>
                            <div class="form-group">
                                <label for="sub_total">Sub Total:</label>
                                <input type="text" name="sub_total" id="sub_total" class="form-control input-default" readonly>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="sale_submit" class="btn btn-primary" value="Sale">
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
<script>

    // Get Product Data

        $('#product_id').on('change',function(){
            let product_id = $(this).val();
            $.ajax({
                type:"POST",
                url: 'ajax.php',
                data:{
                    product_id:product_id
                },
                success: function(response){
                    let productResult = JSON.parse(response);
                    console.log(productResult);
                    if(productResult.count == 0){
                        $('#ajaxError').show().text(productResult.message);
                        $('#manufacture_name').val('');
                    }
                    else{
                        $('#ajaxError').hide();
                        $('#manufacture_name').val(productResult.manufacture_name);
                        $('#manufacture_id').val(productResult.manufacture_id)
                        $('#stock').val(productResult.stock)
                        $('#avilable_stock').text("Avilable Stock : " + productResult.stock)

                        //groups
                        $('#group_name').empty();
                        let groups = productResult.groups;
                        $('#group_name').append('<option value="#">Select Group</option>');

                        $.each(groups,function(i,item){
                            $('<option value="' +groups[i].id+'">').html(
                                '<span>'+groups[i].group_name+'</span>'
                            ).appendTo('#group_name');
                        });
                    }
                }
            });
        });

    //Get Ajax Data
    $('#group_name').on('change',function(){
        let group_id = $(this).val();
        $.ajax({    
            type: "POST",
            url: 'ajax.php',
            data: {
                group_id:group_id
            },
            success:function(response){
                let groupResult = JSON.parse(response);
                $('#expire_date').val(groupResult.expire_date);
                $('#price_item').val(groupResult.price_item);
                $('#manufacture_price').val(groupResult.manufacture_price_item);
            }
        });
    });

    // Get Total Price
    $('#quantity').on('keyup',function(){
        let price = $('#price_item').val();
        let quantity = $(this).val();
        let stock = $('#stock').val();
        if(price.length == 0){
            $('#ajaxError').show().text("Please first select Product and Group");
        }
        else if(!jQuery.isNumeric(quantity)){
            $('#ajaxError').show().text("Quantity use must be number!");
        }
        else if(quantity>stock){
            $('#ajaxError').show().text("Product stock is low!");
        }
        else{
            $('#ajaxError').hide();
            let total_price = price*quantity;

            $('#total_price').val(total_price);
            $('#sub_total').val(total_price);
        }
    })

    //Get discount Amount
    $('#discount_amount').on('keyup',function(){
        let type = $('#discount_type').val();
        let discount_amount = $(this).val();

        if(type == "fixed"){
            if(!jQuery.isNumeric(discount_amount)){
                $('#ajaxError').show().text("Discount amount must be number!");
            }
            else{
                let fixed_price = $('#total_price').val();
                let new_fixed_price = fixed_price-discount_amount;

                $('#sub_total').val(new_fixed_price);
            }
        }

        else if(type == "percentage"){
            if(!jQuery.isNumeric(discount_amount)){
                $('#ajaxError').show().text("Discount amount must be number!");
            }
            else{
                let percentage_price = $('#total_price').val();
                let percentage_amount = percentage_price*discount_amount/100;
                let new_percentage_price = percentage_price-percentage_amount;

                $('#sub_total').val(new_percentage_price);
            }
        }
        else{
            $('#discount_amount').val('');
            let fixed_price = $('#total_price').val();
            $('#sub_total').val(fixed_price);
        }
    })
    $('#discount_type').on('change',function(){
        let dis_type = $(this).val();
        if(dis_type == 'none'){
            $('#discount_amount').val('');
            let fixed_price = $('#total_price').val();
            $('#sub_total').val(fixed_price);
        }
    })




</script>