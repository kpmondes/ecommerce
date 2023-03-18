<?php
    session_start();
    include_once "db_conn.php";
    include_once "sql_utilities.php";

    // Get the item ID and quantity from the POST data
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];

    // Query the database to get the item details
    $query = "SELECT * FROM items WHERE item_id = $item_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Add the item to the cart in the session
    $_SESSION['cart'][] = array(
        'item_id' => $row['item_id'],
        'item_name' => $row['item_name'],
        'item_price' => $row['item_price'],
        'quantity' => $quantity
    );

    // Redirect to the cart page
    header('Location: checkout.php');
    exit();
?>