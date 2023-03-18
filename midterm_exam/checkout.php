<html>
<?php include_once "db_conn.php"; ?>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">

</head>
<body>
	<div class="container">
        <div class="row">
            <div class="col-md-2">
            <h3>Confirm Information</h3>
                
                <?php
                     if(isset($_GET['new_record'])){
                            switch($_GET['new_record']){
                                case "added": echo "<div class='alert alert-success'>Product Added.</div>";
                                      break;
                                case "failed":  echo "<div class='alert alert-danger'>Product Not Added</div>";
                                      break;
                                        
                            }
                       }
                ?>
                <form action="add_product.php" method="post">
                    <div class="mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" required name="username" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" required id="password" name="password" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="fullname" class="form-label">Fullname</label>
                        <input type="fullname" required id="fullname" name="fullname" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="address" class="form-label">Address</label>
                        <input type="address" required id="address" name="address" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="contact_number" required id="contact_number" name="contact_number" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Confirm</button>
                </form>
            </div>

            <div class="col-7">
            <h1>Checkout</h1>


            <?php

// Check if the form has been submitted
if (isset($_POST['item_id'])) {

    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "product");

    // Retrieve the product information
    $query = "SELECT * FROM items WHERE item_id = " . $_POST['item_id'];
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);

    // Calculate the subtotal
    $subtotal = $product['item_price'] * $_POST['quantity'];

    // Add the item to the cart
    session_start();
    $cart_item = array(
        'item_id' => $product['item_id'],
        'item_name' => $product['item_name'],
        'item_price' => $product['item_price'],
        'quantity' => $_POST['quantity'],
        'subtotal' => $subtotal
    );
    $_SESSION['cart'][] = $cart_item;

    // Close the database connection
    mysqli_close($conn);
}

// Remove item from the cart
if (isset($_POST['remove_item_id'])) {
    $remove_item_id = $_POST['remove_item_id'];

    // Loop through the cart to find the item with the matching ID
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['item_id'] == $remove_item_id) {
            // Remove the item from the cart
            unset($_SESSION['cart'][$key]);
            break;
                }
            }
        }

            // Display the cart contents
            if (isset($_SESSION['cart'])) {

    // Initialize the total amount
    $total_amount = 0;

    // Display the cart table
    echo "<table class='table table-bordered'>";
    echo '<thead><tr>';
    echo '<th>Item Name</th>';
    echo '<th>Item Price</th>';
    echo '<th>Item Quantity</th>';
    echo '<th>Subtotal</th>';
    echo '</tr></thead>';
    echo '<tbody>';

    foreach ($_SESSION['cart'] as $key => $item) {

        // Display the item details
        echo '<tr>';
        echo '<td>' . $item['item_name'] . '</td>';
        echo '<td>$' . number_format($item['item_price'], 2) . '</td>';
        echo '<td>' . $item['quantity'] . '</td>';
        echo '<td>$' . number_format($item['subtotal'], 2) . '</td>';
        echo '</tr>';

        // Add the subtotal to the total amount
        $total_amount += $item['subtotal'];
    }

    // Display the total amount with label
    echo '<tr><td colspan="3"></td><td>Total Amount:</td><td>$' . number_format($total_amount, 2) . '</td></tr>';

                echo '</tbody></table>';

                } else {
            echo '<p>Your cart is empty.</p>';
        }


?>
</div>
</div>

</body>
<script src="js/bootstrap.js"></script>
</html>
           





            