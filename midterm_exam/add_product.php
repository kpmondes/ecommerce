<?php
// Include the database connection file and SQL utilities file
include_once "db_conn.php";
include_once "sql_utilities.php";

// Check if the 'item_name' parameter was provided in the POST request
if(isset($_POST['item_name'])){
    // If the parameter exists, store its value in the $item_name variable
    $item_name=$_POST['item_name'];
    // Store the 'item_price' parameter value in the $item_price variable
    $item_price=$_POST['item_price'];


    // Define the table name and an associative array of fields to be inserted into the table
    $table = "items";
    $fields = array('item_name' => $item_name
                   , 'item_price' => $item_price
                   );
    // Call the insert() function from the sql_utilities.php file to insert a new record with the provided data
    if(insert($conn, $table, $fields) ){

        // If the insert is successful, redirect the user to the index.php page with a success message
        header("location: index.php?new_record=added");
        exit();
    }  
    else{
        // If the insert fails, redirect the user to the index.php page with a failure message
        header("location: index.php?new_record=failed");
        exit();
    }
}
?>

