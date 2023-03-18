<?php

    //delete_item.php

//include the database connection file and the SQL utilities file
include_once "db_conn.php";
include_once "sql_utilities.php";

// Check if the 'item_id' parameter was provided in the GET request
if(isset($_GET['item_id'])){
    // If the parameter exists, store its value in the $item_id variable
    $item_id = $_GET['item_id'];
    // Create an array of parameters to be passed to the SQL query
    $params = array($item_id);

    // Call the query() function from the sql_utilities.php file to delete the item with the given ID
    if(query($conn, "DELETE FROM items WHERE item_id = ?", $params) ){

        // If the query is successful, redirect the user to the index.php page with a success message
       header("location: index.php?product_delete=done");
       exit();
    }

    // If the query fails, redirect the user to the index.php page with a failure message
    else{
       header("location: index.php?product_delete=failed");
       exit();
    } 
}
?>


