
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
                <h3>Add a Product</h3>
                
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
                    <div class="mb-3">
                        <label for="item_name" class="form-label">Product Name</label>
                        <input type="text" id="item_name" required name="item_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="item_price" class="form-label">Price</label>
                        <input type="Price" required id="item_price" name="item_price" class="form-control">
                    </div>

                    <input type="submit" class="btn btn-primary">
                </form>
            </div>

            <div class="col-8">
                <h3> PRODUCT </h3>
                <?php 
                    $product_list = mysqli_query($conn, "SELECT item_id, item_name, item_price FROM items WHERE item_status = 'A'");
                    echo "<hr>";
                    if(isset($_GET['update_status'])){
                        switch($_GET['update_status']){
                            case "added": 
                                echo "<div class='alert alert-success'>Product Added.</div>";
                                break;
                            case "failed":  
                                echo "<div class='alert alert-danger'>Product Not Added</div>";
                                break;
                        }
                    }
                    echo "<hr>";
  
                    echo "<table class='table table-bordered'>";
                    echo "<thead>";
                    echo "<th>Product name</th>";
                    echo "<th>Price</th>";
                    echo "<th>Action</th>";
                    echo "</thead>";
                    while($row = mysqli_fetch_assoc($product_list)){
                        echo "<tr>";
                        echo "<td>" . $row['item_name'] . "</td>";
                        echo "<td>" . $row['item_price'] . "</td>";
                        echo "<td> <a class='btn btn-success' href='submit.php?item_id=" . $row['item_id'] . "&item_name=" . $row['item_name'] . "&item_price=" . $row['item_price'] . "' > Update </a> </td>";
                        echo "<td> <a class='btn btn-danger' href='delete_item.php?item_id=". $row['item_id'] ."'> Delete </a> </td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                ?>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
    
    <script src="js/bootstrap.js"></script>
</body>
</html>

