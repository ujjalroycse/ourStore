
<?php 

require_once('../config.php');
require_once('../includes/header.php');
$user_id = $_SESSION['user']['id'];
if(isset($_POST['manufacture_submit'])){

    $manufacture_name = $_POST['manufacture_name'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $mobileCount = getColumnCount('manufacture','mobile',$mobile);

    if(empty($manufacture_name)){
        $error = "Manufacture name is required!";
    }
    elseif(empty($address)){
        $error = "Address is required!";
    }
    elseif(empty($mobile)){
        $error = "Mobile number is required!";
    }
    elseif($mobileCount != 0){
        $error = "Mobile number already used!";
    }
    elseif(!is_numeric($mobile)){
        $error = "Use valid mobile number!";
    }
    elseif(strlen($mobile) != 11){
        $error = "Mobile number is wrong!";
    }
    else{
        $date = date('Y-m-d H:i:s');
        $statement=$connection->prepare("INSERT INTO manufacture(user_id,name,address,mobile,created_at) VALUES(?,?,?,?,?)");
        $statement->execute(array($user_id,$manufacture_name,$address,$mobile,$date));

        $success = "Manufacture create successfully!";
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
                                <label for="manufacture_name">Manufacture Name :</label>
                                <input id="manufacture_name" type="text" name="manufacture_name" class="form-control input-default" placeholder="Manufacture Name">
                            </div>
                            <div class="form-group">
                                <label for="address">Address :</label>
                                <input type="text" name="address" id="address" class="form-control input-default" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile Number :</label>
                                <input type="text" name="mobile" id="mobile" class="form-control input-default" placeholder="Mobile number">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="manufacture_submit" class="btn btn-success" value="Create">
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