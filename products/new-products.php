
<?php 

require_once('../config.php');
require_once('../includes/header.php');
$user_id = $_SESSION['user']['id'];
if(isset($_POST['product_submit'])){

    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $description = $_POST['description'];
    $photo = $_FILES['photo'];

    $target_directory = "../uploads/products/";
    $target_file = $target_directory . basename($_FILES["photo"]["name"]);
    $photoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    if(empty($product_name)){
        $error = "Product name is required!";
    }
    elseif(empty($product_category)){
        $error = "Select category is required!";
    }
    elseif(empty($photo['name'])){
        $error = "Photo is required!";
    }
    elseif($photoFileType != 'jpg' && $photoFileType != 'png' && $photoFileType != 'jpeg'){
        $error = "Use photo extension jpg or png or jpeg!";
    }
    else{
        $new_photo_name = $user_id." - ".rand(1111,9999)."-".time()."." .$photoFileType;
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_directory.$new_photo_name);

        $date = date('Y-m-d H:i:s');
        $statement=$connection->prepare("INSERT INTO products(user_id,product_name,category_id,description,stock,photo,created_at) VALUES(?,?,?,?,?,?,?)");
        $statement->execute(array($user_id,$product_name,$product_category,$description,'NULL',$new_photo_name,$date));

        $success = "Category create successfully!";
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="product_name">Product Name :</label>
                                <input id="product_name" type="text" name="product_name" class="form-control input-default" placeholder="Product Name">
                            </div>
                            <div class="form-group">
                                <label for="product_category">Select Cateogry :</label>
                                <select name="product_category" id="product_category" class="form-control input-default">
                                    <?php 
                                    $categories = getTableData('categories');
                                    foreach($categories as $category) : 
                                    ?>
                                    <option value="<?php echo $category['id']?>"><?php echo $category['category_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Description :</label>
                                <textarea class="form-control input-default summernote" name="description" id="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo :</label>
                                <input type="file" name="photo" id="photo" class="form-control input-default">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="product_submit" class="btn btn-success" value="Create">
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