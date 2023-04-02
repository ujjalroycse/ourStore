
<?php 

require_once('../config.php');
get_header();
$id = $_REQUEST['id'];
$user_id = $_SESSION['user']['id'];

if(isset($_POST['update_form'])){

    $manufacture_name = $_POST['manufacture_name'];
    $address = $_POST['address'];

    if(empty($manufacture_name)){
        $error = "Manufacture name is required!";
    }
    elseif(empty($address)){
        $error = "Address is required!";
    }
    else{
        $date = date('Y-m-d H:i:s');
        $statement=$connection->prepare("UPDATE manufacture SET name=?,address=? WHERE user_id=? AND id=?");
        $statement->execute(array($manufacture_name,$address,$user_id,$id));

        $success = "Manufacture update successfully!";
    }
}

?>

<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 offset-md-1">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Update Manufacture</h3>
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
                            $manufacture_data = getSingleData('manufacture',$id);
                            ?>
                            <div class="form-group">
                                <label for="manufacture_name">Create Manufacture :</label>
                                <input id="manufacture_name" type="text" name="manufacture_name" value="<?php echo $manufacture_data['name'] ?>" class="form-control input-default" >
                            </div>
                            <div class="form-group">
                                <label for="address">Address :</label>
                                <input id="address" type="text" name="address" value="<?php echo $manufacture_data['address'] ?>" class="form-control input-default" >
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