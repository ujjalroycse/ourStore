
<?php 

require_once('../config.php');
get_header();
$id = $_REQUEST['id'];
$user_id = $_SESSION['user']['id'];

if(isset($_POST['update_form'])){

    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $description = $_POST['description'];
    $photo = $_FILES['photo'];

    $target_directory = "../uploads/products/";
    
    if(empty($product_name)){
        $error = "Product name is required!";
    }
    elseif(empty($product_category)){
        $error = "Product category is required!";
    }
    else{

        $image_link = getPurchasesData('products','photo',$id);
        if(!empty($_FILES["photo"]["name"])){

            $target_file = $target_directory . basename($_FILES["photo"]["name"]);
            $photoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if($photoFileType != 'jpg' && $photoFileType != 'png' && $photoFileType != 'jpeg'){
                $error = "Use photo extension jpg or png or jpeg!";
            }
            else{
                $new_photo_name = $user_id." - ".rand(1111,9999)."-".time()."." .$photoFileType;
                move_uploaded_file($_FILES["photo"]["tmp_name"], $target_directory.$new_photo_name);

                if(file_exists($target_directory.$image_link)){
                    unlink($target_directory.$image_link);
                }
            }
            $image_link = $new_photo_name;
        }

        
            $statement=$connection->prepare("UPDATE products SET product_name=?,category_id=?,description=?,photo=? WHERE id=?");
            $statement->execute(array($product_name,$product_category,$description,$image_link,$id));
    
            $success = "Product update successfully!";
        
    }
}

?>

<!-- if(!empty($_FILES["photo"]["name"])){

$target_file = $target_directory . basename($_FILES["photo"]["name"]);
$photoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if($photoFileType != 'jpg' && $photoFileType != 'png' && $photoFileType != 'jpeg'){
    $error = "Use photo extension jpg or png or jpeg!";
}
else{
    $new_photo_name = $user_id." - ".rand(1111,9999)."-".time()."." .$photoFileType;
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_directory.$new_photo_name);

    $statement=$connection->prepare("UPDATE products SET product_name=?,category_id=?,description=?,photo=? WHERE id=?");
    $statement->execute(array($product_name,$product_category,$description,$new_photo_name,$id));

    $success = "Product update successfully!";
}
}
else{
$statement=$connection->prepare("UPDATE products SET product_name=?,category_id=?,description=? WHERE id=?");
$statement->execute(array($product_name,$product_category,$description,$id));

$success = "Product update successfully!";
} -->

<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Update Product</h3>
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            <?php 
                            $product_data = getSingleData('products',$id);
                            ?>
                            <div class="form-group">
                                <label for="product_name">Create Product :</label>
                                <input id="product_name" type="text" name="product_name" value="<?php echo $product_data['product_name'] ?>" class="form-control input-default" >
                            </div>
                            <div class="form-group">
                                <label for="product_category">Category :</label>
                                <select name="product_category" id="product_category" class="form-control input-default">
                                    <?php 
                                    $categories = getTableData('categories');
                                    foreach($categories as $category) : 
                                    ?>
                                    <option value="<?php echo $category['id']?>"
                                        <?php 
                                            if( $category['id'] == $product_data['category_id']){
                                                echo "selected";
                                            }
                                        ?>
                                    ><?php echo $category['category_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Description :</label>
                                <textarea class="form-control input-default summernote" name="description" id="description"><?php echo $product_data['description'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo :</label>
                                <input type="file" name="photo" id="photo" value="<?php echo $product_data['photo']; ?>" class="form-control input-default">
                                <br> 
                                <div class="images">
                                    <img style="width:150px; height:auto" src="../uploads/products/<?php echo $product_data['photo']; ?>">
                            </div><br>
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
// require_once('../includes/footer.php');
?>