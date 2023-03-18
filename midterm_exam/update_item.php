<?php
include_once "db_conn.php";
include_once "sql_utilities.php";

if(isset($_POST['item_id'])){
    $table = "items";
    
    $p_item_id  = $_POST['item_id'];
    $p_item_name= $_POST['item_name'];
    $p_item_price = $_POST['item_price'];
    
    
    $fields = array( 'item_id' => $p_item_id
                   , 'item_name' => $p_item_name
                   , 'item_price' => $p_item_price 
                   );
    $filter = array( 'item_id' => $p_item_id );
    
   
   if( update($conn, $table, $fields, $filter )){
       header("location: index.php?update_status=success");
       exit();
   }
    else{
        header("location: index.php?update_status=failed");
        exit();
    }
 }
?>



