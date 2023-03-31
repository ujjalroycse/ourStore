
<?php 

require_once('../config.php');
require_once('../includes/header.php');
// get_header();
$user_id = $_SESSION['user']['id'];
if(isset($_POST['category_submit'])){

    $category_name = $_POST['category_name'];
    $category_slug = $_POST['category_slug'];
    $slugCount = getColumnCount('categories','category_slug',$category_slug);

    $charatcers = "/^[a-z-0-9]+$/";

    if(empty($category_name)){
        $error = "Category name is required!";
    }
    elseif(empty($category_slug)){
        $error = "Category slug is required!";
    }
    elseif($slugCount != 0){
        $error = "Category slug already exists!";
    }
    elseif(!preg_match($charatcers, $category_slug)){
        $error = "Use only small letter!";
    }
    else{
        $date = date('Y-m-d H:i:s');
        $statement=$connection->prepare("INSERT INTO categories(user_id,category_name,category_slug,created_at) VALUES(?,?,?,?)");
        $statement->execute(array($user_id,$category_name,$category_slug,$date));

        $success = "Category create successfully!";
    }
}

?>

<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Create New Category</h3>
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
                            <div class="form-group">
                                <label for="category_name">Create Category :</label>
                                <input id="category_name" type="text" name="category_name" class="form-control input-default" placeholder="Category Name">
                            </div>
                            <div class="form-group">
                                <label for="category_slug">Category Slug :</label>
                                <input id="category_slug" type="text" name="category_slug" class="form-control input-default" placeholder="Category Slug">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="category_submit" class="btn btn-success" value="Create">
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