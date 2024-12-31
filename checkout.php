<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $registrationNumber = $_POST['registrationNumber'];
    $cardNumber = $_POST['cardNumber'];
    $mobileNumber = $_POST['mobileNumber'];

    // Get orderId from the URL parameter
    $orderId = $_GET['orderId'];

    // Update data in the orders table
    $updateOrderSql = "UPDATE orders SET PAYMENT_STATUS = 1, DATE = CONVERT_TZ(NOW(), 'UTC', 'Asia/Kolkata'), REG_NO = '$registrationNumber', CARD_NUMBER = '$cardNumber', MOBILE = '$mobileNumber' WHERE ID = '$orderId'";

    if ($conn->query($updateOrderSql) === TRUE) {
        // Close the database connection
        $conn->close();

        // Show success alert and redirect to index.php
        echo "<script>alert('Order successful!'); window.location.href = 'index.php';</script>";
        exit();
    } else {
        echo "<p>Error updating order: " . $conn->error . "</p>";
    }
}
?>

<div class="container d-flex justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center mb-4">Checkout</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="registrationNumber" class="form-label">Registration Number</label>
                <input type="text" class="form-control" id="registrationNumber" name="registrationNumber" required>
            </div>
            <div class="mb-3">
                <label for="cardNumber" class="form-label">Card Number</label>
                <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
            </div>
            <div class="mb-3">
                <label for="mobileNumber" class="form-label">Mobile Number</label>
                <input type="text" class="form-control" id="mobileNumber" name="mobileNumber" required>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary me-2">Confirm</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>