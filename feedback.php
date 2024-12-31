<?php
// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registration_number = $conn->real_escape_string($_POST["registration_number"]);
    $feedback = $conn->real_escape_string($_POST["feedback"]);

    // Insert data into the database
    $sql = "INSERT INTO feedback (REG_NO, FEEDBACK) VALUES ('$registration_number', '$feedback')";

    if ($conn->query($sql) === TRUE) {
        // Display alert and redirect on success
        echo "<script>alert('Your feedback has been submitted successfully.'); window.location.href = 'index.php';</script>";
        exit();
    } else {
        // Display error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<div class="container d-flex justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center mb-4">Feedback Form</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="registration_number" class="form-label">Registration Number:</label>
                <input type="text" class="form-control" id="registration_number" name="registration_number"
                    maxlength="100" required>
            </div>
            <div class="mb-3">
                <label for="feedback" class="form-label">Feedback:</label>
                <textarea class="form-control" id="feedback" name="feedback" rows="10" cols="50" maxlength="50000"
                    required></textarea>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button type="button" class="btn btn-secondary" onclick="location.href='index.php'">Cancel</button>
            </div>
        </form>
    </div>
</div>