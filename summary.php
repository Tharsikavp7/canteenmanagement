<div class="container d-flex justify-content-center">
    <div class="col-md-6 container">
        <h2 class="text-center mb-4">Order Summary</h2>

        <?php
        $orderId = $_GET['orderId'];
        $fetchOrderDetailsSql = "SELECT * FROM orders_menu WHERE ORDER_ID = '$orderId'";
        $orderDetailsResult = $conn->query($fetchOrderDetailsSql);

        if ($orderDetailsResult->num_rows > 0) {
            echo "<table class='table table-bordered'>";
            echo "<thead><tr><th>Item Name</th><th>Quantity</th><th>Price</th></tr></thead>";
            echo "<tbody>";

            while ($row = $orderDetailsResult->fetch_assoc()) {
                // Fetch menu item details based on MENU_ID
                $menuId = $row['MENU_ID'];
                $fetchMenuItemSql = "SELECT NAME, UNIT_PRICE FROM menu WHERE ID = '$menuId'";
                $menuItemResult = $conn->query($fetchMenuItemSql);

                if ($menuItemResult->num_rows > 0) {
                    $menuItem = $menuItemResult->fetch_assoc();
                    $itemName = $menuItem['NAME'];
                    $quantity = $row['COUNT'];
                    $price = $row['PRICE'];

                    echo "<tr><td>$itemName</td><td>$quantity</td><td>" . number_format($price, 2) . "</td></tr>";
                }
            }

            echo "</tbody>";
            echo "<tfoot><tr><td colspan='2' class='text-end'>Total Price:</td><td>";

            // Fetch total price from orders table based on ORDER_ID
            $fetchTotalPriceSql = "SELECT TOTAL_PRICE FROM orders WHERE ID = '$orderId'";
            $totalPriceResult = $conn->query($fetchTotalPriceSql);

            if ($totalPriceResult->num_rows > 0) {
                $totalPrice = $totalPriceResult->fetch_assoc()['TOTAL_PRICE'];
                echo number_format($totalPrice, 2);
            }

            echo "</td></tr></tfoot>";
            echo "</table>";
        } else {
            echo "<p>No items found for the order.</p>";
        }
        ?>

        <div class="d-flex justify-content-center">
            <a href="index.php?page=checkout.php&orderId=<?php echo $orderId; ?>" class="btn btn-primary me-2">Checkout</a>
            <a href="index.php" class="btn btn-secondary ms-2">Cancel</a>
        </div>
    </div>
</div>