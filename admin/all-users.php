
<?php 

require_once('../config.php');
admin_header();
// $id = $_SESSION['user']['id'];

?>

    <!--**********************************
        Content body start
    ***********************************-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    
                    <div class="card-body">
                        <h3 class="card-title">All Users</h3>

                        <?php if(isset($_REQUEST['success'])) : ?>
                        <div class="alert alert-success">
                            <?php echo $_REQUEST['success']; ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered" id="userTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $users = getAdminData('users');
                                    $i = 1;
                                    foreach($users as $user):
                                    ?>
                                    <tr>
                                        <td><?php echo $i;$i++; ?></td>
                                        <td><a href="user-profile-view.php?id=<?php echo $user['id'] ?>"><?php echo $user['name']; ?></a></td>
                                        <td><?php echo $user['mobile'] ?></td>
                                        <td><?php echo $user['email'] ?></td>
                                        <td><?php 
                                        if($user['status'] == 'Active'){
                                            echo "<span class='badge badge-success'>Active</span>";
                                        }
                                        elseif($user['status'] == 'Pending'){
                                            echo "<span class='badge badge-warning'>Pending</span>";
                                        }
                                        else{
                                            echo "<span class='badge badge-danger'>".$user['status']."</span>";
                                        }
                                        ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="user-profile-view.php?id=<?php echo  $user['id'];?>"><i class="fa fa-eye"></i></a>
                                            <?php if($user['status'] == 'Blocked'): ?>
                                                <a class="btn btn-sm btn-warning" onclick="return confirm('Are you sure?') " href="unblock.php?id=<?php echo  $user['id'];?>">Unblock</a>
                                            <?php else: ?>
                                                <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?') " href="block.php?id=<?php echo  $user['id'];?>">Block</a>
                                            <?php endif; ?>
                                        </td>
                                       
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>  
            </div>
        </div>
    </div>
    <!-- #/ container -->
    
<?php 
admin_footer(); 

?>