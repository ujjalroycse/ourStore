
<?php 

require_once('../config.php');
admin_header();
$id = $_SESSION['user']['id'];

if(isset($_POST['month_filter'])){
    $selectedMonth = $_POST['select_month'];
    $stm=$connection->prepare("SELECT * FROM sales WHERE MONTH(created_at)=?");
    $stm->execute(array($selectedMonth));
    $monthly_result = $stm->fetchAll(PDO::FETCH_ASSOC);
}
if(isset($_POST['date_to_date_filter'])){
    $selectFormDate = $_POST['form_date'];
    $selectToDate = $_POST['to_date'];
    $stm=$connection->prepare("SELECT * FROM sales WHERE created_at BETWEEN ? AND ?");
    $stm->execute(array($selectFormDate,$selectToDate));
    $date_to_date_result = $stm->fetchAll(PDO::FETCH_ASSOC);
}

$thisMonth = date('m');
$stm = $connection->prepare("SELECT * FROM sales WHERE MONTH(created_at)=?");
$stm->execute(array($thisMonth));

$result = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

    <!--**********************************
        Content body start
    ***********************************-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="select_month" class="text-danger"><b><i>Filter with month :</i></b></label>
                                    <select name="select_month" id="select_month" class="form-control input-default">
                                        <option value="1">January</option>
                                        <option value="2">Fabruary</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">Saptember</option>
                                        <option value="10">Octomber</option>
                                        <option value="11">Novamber</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="filter"><br></label>
                                    <input type="submit" name="month_filter" id="filter" value="Filter" class="form-control input-default btn btn-info">
                                </div>
                            </div>
                        </form>
                        <br>

                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="form_date"><i>Form Date :</i></label>
                                    <input type="date" name="form_date" id="form_date" class="form-control input-default">
                                </div>
                                <div class="col-md-3">
                                    <label for="to_date"><i>To Date :</i></label>
                                    <input type="date" name="to_date" id="to_date" class="form-control input-default">
                                </div>
                                <div class="col-md-2">
                                    <label for="date_filter"><br></label>
                                    <input type="submit" name="date_to_date_filter" id="date_filter" value="Filter" class="form-control input-default btn btn-info">
                                </div>
                            </div>
                        </form>
                        <br>

                        <?php if(isset($_POST['date_to_date_filter'])): ?>

                        <h3 class="card-title">Form Date : <mark><?php echo $_POST['form_date'] ; ?></mark> To Date : <mark><?php echo $_POST['to_date'] ?></mark> Sales Reports</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Date</th>
                                        <th>User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    foreach($date_to_date_result as $sale):
                                        $userData = getProfile($sale['user_id'])
                                    ?>
                                    <tr>
                                        <td><?php echo $i;$i++; ?></td>
                                        <td><?php echo $sale['customer_name']; ?></td>
                                        <td><a href="sale-view.php?id=<?php echo $sale['user_id'] ?>"><?php echo getPurchasesData('products','product_name',$sale['product_id']); ?></a></td>
                                        <td><?php echo $sale['quantity'] ?></td>
                                        <td><?php echo $sale['sub_total'] ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($sale['created_at'])) ?></td>
                                        <td><a href="user-profile-view.php?id=<?php echo $sale['user_id']?>"><?php echo $userData['name'] ?></a></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <?php elseif(isset($_POST['month_filter'])): ?>

                        <h3 class="card-title">Current Month ( <b class="text-red"><?php echo date('F', mktime(0, 0, 0, $_POST['select_month'], 10)); ?></b> ) Sales Reports</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Date</th>
                                        <th>User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    foreach($monthly_result as $sale):
                                        $userData = getProfile($sale['user_id'])
                                    ?>
                                    <tr>
                                        <td><?php echo $i;$i++; ?></td>
                                        <td><?php echo $sale['customer_name']; ?></td>
                                        <td><a href="sale-view.php?id=<?php echo $sale['user_id'] ?>"><?php echo getPurchasesData('products','product_name',$sale['product_id']); ?></a></td>
                                        <td><?php echo $sale['quantity'] ?></td>
                                        <td><?php echo $sale['sub_total'] ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($sale['created_at'])) ?></td>
                                        <td><a href="user-profile-view.php?id=<?php echo $sale['user_id']?>"><?php echo $userData['name'] ?></a></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <?php else: ?>

                         <h3 class="card-title">Current Month ( <?php echo date('F'); ?> ) Sales Reports</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Date</th>
                                        <th>User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    foreach($result as $sale):
                                        $userData = getProfile($sale['user_id'])
                                    ?>
                                    <tr>
                                        <td><?php echo $i;$i++; ?></td>
                                        <td><?php echo $sale['customer_name']; ?></td>
                                        <td><a href="sale-view.php?id=<?php echo $sale['user_id'] ?>"><?php echo getPurchasesData('products','product_name',$sale['product_id']); ?></a></td>
                                        <td><?php echo $sale['quantity'] ?></td>
                                        <td><?php echo $sale['sub_total'] ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($sale['created_at'])) ?></td>
                                        <td><a href="user-profile-view.php?id=<?php echo $sale['user_id']?>"><?php echo $userData['name'] ?></a></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php endif; ?>
                    </div>

                </div>  
            </div>
        </div>
    </div>
    <!-- #/ container -->
    
<?php 
admin_footer();
?>