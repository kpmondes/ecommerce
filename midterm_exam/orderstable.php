
<!DOCTYPE html>
<html>
<head>
	<title>Orders Table</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<style>
		table {
			margin-top: 20px;
			border-collapse: collapse;
			width: 100%;
			border: 1px solid #ddd;
			font-size: 18px;
			text-align: left;
		}

		th, td {
			padding: 12px;
			border: 1px solid #ddd;
		}

		th {
			background-color: #f2f2f2;
			color: #333;
			font-weight: bold;
			text-align: center;
		}

		td {
			text-align: center;
		}

		.btn-buy-now {
			background-color: #4CAF50;
			color: white;
			padding: 10px 16px;
			margin: 4px 2px;
			border: none;
			cursor: pointer;
			border-radius: 5px;
		}
	</style>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-12">
			<h1 class="text-center">Orders Table</h1>

			<?php

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "product");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Query database for all items
$query = "SELECT * FROM items";
$result = mysqli_query($conn, $query);

// Display items in a table
if (mysqli_num_rows($result) > 0) {
    echo '<table class="items">';
    echo '<thead>';
    echo '<tr>';
    echo '<th style="display:none;">Item ID</th>';
    echo '<th>Item Name</th>';
    echo '<th>Item Price</th>';
    echo '<th>Item Quantity</th>';
    echo '<th style="text-align: center">Action</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td style="display:none;">' . $row['item_id'] . '</td>';
        echo '<td>' . $row['item_name'] . '</td>';
        echo '<td>$' . number_format($row['item_price'], 2) . '</td>';

        echo '<td>';
        echo '<form method="POST" action="checkout.php">';
        echo '<input type="hidden" name="item_id" value="' . $row['item_id'] . '">';
        echo '<input type="number" name="quantity" value="1" min="1">';
        echo '</td>';
        echo '<td style="text-align: center">';
        echo '<button type="submit" class="btn-buy-now">Buy Now</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>No items found.</p>';
}

// Close database connection
mysqli_close($conn);

?>
		</div>
	</div>
</div>
<script src="js/bootstrap.js"></script>
</body>
</html>

