<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the total price from the form
    $totalPrice = floatval($_POST['totalPrice']);

    // Insert data into the orders table
    $insertOrderSql = "INSERT INTO orders (TOTAL_PRICE, PAYMENT_STATUS) VALUES ('$totalPrice', '0')";
    if ($conn->query($insertOrderSql) === TRUE) {
        // Get the auto-generated ID of the orders table
        $orderId = $conn->insert_id;

        // Iterate through the menu items and insert data into orders_menu
        foreach ($_POST['quantity'] as $menuId => $count) {
            $menuId = intval($menuId);
            $count = intval($count);

            if ($count > 0) {
                $price = $count * floatval($_POST['price'][$menuId]);

                // Insert data into orders_menu
                $insertOrderMenuSql = "INSERT INTO orders_menu (ORDER_ID, MENU_ID, COUNT, PRICE) VALUES ('$orderId', '$menuId', '$count', '$price')";
                $conn->query($insertOrderMenuSql);
            }
        }

        // Close the database connection
        $conn->close();

        // Redirect to summary.php after successful insertion
        header("Location: index.php?page=summary.php&orderId=$orderId");
        exit();
    } else {
        echo "Error: " . $insertOrderSql . "<br>" . $conn->error;
    }
}
?>
<style>
    .count-input {
        width: 60px;
        /* Adjust as needed */
    }
</style>

<div class="container d-flex justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center mb-4">Food Menu</h2>
        <form id="orderForm" method="POST" action="">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch menu items from the database
                    $sql = "SELECT ID as id, NAME as name, UNIT_PRICE as price FROM menu";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr data-id='" . $row['id'] . "'>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . number_format($row['price'], 2) . "</td>";
                            echo "<td>";
                            echo "<div class='d-flex'>";
                            echo "<button class='btn btn-secondary btn-sm count-minus'>-</button>";
                            echo "<input type='text' class='form-control count-input' name='quantity[" . $row['id'] . "]' value='0'>";
                            echo "<input type='hidden' name='price[" . $row['id'] . "]' value='" . $row['price'] . "'>";
                            echo "<button class='btn btn-primary btn-sm count-plus'>+</button>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No menu items found.</td></tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-end">Total Price:</td>
                        <td id="totalPrice" class="text-bold">0</td>
                        <!-- Add a hidden input field for total price -->
                        <input type="hidden" name="totalPrice" id="hiddenTotalPrice" value="0">
                    </tr>
                </tfoot>
            </table>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary me-2" id="placeOrder">Place Order</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<!-- Custom JavaScript for AJAX functionality -->
<script>
    $(document).ready(function () {
        // Fetch and display menu items initially (already done in PHP)

        // Real-time quantity and price updates
        $(".count-minus, .count-plus").click(function () {
            event.preventDefault(); // Prevent form submission
            var id = $(this).closest("tr").data("id");
            var input = $(this).closest("div").find(".count-input");
            var count = parseInt(input.val());
            var price = parseFloat($(this).closest("tr").find("td:nth-child(2)").text());

            if ($(this).hasClass("count-minus") && count > 0) {
                count--;
            } else if ($(this).hasClass("count-plus")) {
                count++;
            }

            input.val(count);
            updateTotalPrice();

            // Update the hidden input fields for quantity dynamically
            $("input[name='quantity[" + id + "]']").val(count);
            // Update the hidden input fields for total price dynamically
            updateHiddenTotalPrice();
        });

        function updateTotalPrice() {
            event.preventDefault(); // Prevent form submission
            var total = 0;
            $(".count-input").each(function () {
                var id = $(this).closest("tr").data("id");
                var count = parseInt($(this).val());
                var price = parseFloat($(this).closest("tr").find("td:nth-child(2)").text());
                total += count * price;
            });
            $("#totalPrice").text(total.toFixed(2));
            updateHiddenTotalPrice();
        }

        function updateHiddenTotalPrice() {
            // Update the hidden input field for total price
            var hiddenTotalPrice = parseFloat($("#totalPrice").text());
            $("#hiddenTotalPrice").val(hiddenTotalPrice.toFixed(2));
        }
    });
</script>