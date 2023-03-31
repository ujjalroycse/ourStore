
<?php 

require_once('../config.php');
// require_once('../includes/header.php');
get_header();
$id = $_REQUEST['id'];
$user_id = $_SESSION['user']['id'];

if(isset($_POST['update_form'])){

    $category_name = $_POST['category_name'];
    $category_slug = $_POST['category_slug'];

    $slugCount = getColumnCount('categories','category_slug',$category_slug);
    $charatcers = "/^[a-z-0-9]+$/";

    $statement=$connection->prepare("SELECT category_slug FROM categories WHERE category_slug=? AND id=?");
    $statement->execute(array($category_slug,$id));
    $ownSlugCount = $statement->rowCount();

    if(empty($category_name)){
        $error = "Category name is required!";
    }
    elseif(empty($category_slug)){
        $error = "Category slug is required!";
    }
    elseif($slugCount != 0 AND $ownSlugCount != 1){
        $error = "Category slug already exists!";
    }
    elseif(!preg_match($charatcers, $category_slug)){
        $error = "Use only small letter!";
    }
    else{
        $date = date('Y-m-d H:i:s');
        $statement=$connection->prepare("UPDATE categories SET category_name=?,category_slug=? WHERE user_id=? AND id=?");
        $statement->execute(array($category_name,$category_slug,$user_id,$id));

        $success = "Category update successfully!";
    }
}

?>

<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Update Category</h3>
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
                            $category_data = getSingleData('categories',$id);
                            ?>
                            <div class="form-group">
                                <label for="category_name">Create Category :</label>
                                <input id="category_name" type="text" name="category_name" value="<?php echo $category_data['category_name'] ?>" class="form-control input-default" >
                            </div>
                            <div class="form-group">
                                <label for="category_slug">Category Slug :</label>
                                <input id="category_slug" type="text" name="category_slug" value="<?php echo $category_data['category_slug'] ?>" class="form-control input-default" >
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
// require_once('../includes/footer.php');
?>