<?php 
require_once('../config.php');

// Get Product details
if(isset($_POST['product_id'])){
    $statement = $connection->prepare("SELECT product_id,manufacture_id FROM purchases WHERE product_id=? ");
    $statement->execute(array($_POST['product_id']));
    $productCount = $statement->rowCount();

    if($productCount != 0){
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $manufacture_name = getManufactureName('name',$result['manufacture_id']);

        // Get Groups
        $stm = $connection->prepare("SELECT id,group_name,product_id FROM groups WHERE product_id=?");
        $stm->execute(array($_POST['product_id']));
        $groups = $stm->fetchALL(PDO::FETCH_ASSOC);

        //Get Product stock
        $stock = getPurchasesData('products','stock',$_POST['product_id']);

        $data = array(
            'message' => 'Product get success',
            'count' => $productCount,
            'manufacture_id' => $result['manufacture_id'],
            'manufacture_name' => $manufacture_name,
            'stock' => $stock,
            'groups' => $groups
        );
    }
    else{
        $data = array(
            'count' => $productCount,
            'message' => 'Product out of stock'
        );
    }
    echo json_encode($data);
}

// Get Group Details
if(isset($_POST['group_id'])){

    $statement = $connection->prepare("SELECT id,price_item,manufacture_price_item,expire_date FROM groups where id=?");
    $statement->execute(array($_POST['group_id']));
    $print = $statement->fetch(PDO::FETCH_ASSOC);

    echo json_encode($print);



}



?>
