<?php
// Include necessary files
include("includes/includedFiles.php");
include("includes/config.php");

// Function to subscribe the user
function subscribeUser($con, $username) {
    // Prepare the SQL statement
    $query = $con->prepare("INSERT INTO subscribed_users (username) VALUES (?)");
    
    // Check for errors in preparing the query
    if (!$query) {
        die("Error preparing query: " . $con->error);
    }
    
    // Bind parameters and execute the query
    $query->bind_param("s", $username);
    if (!$query->execute()) {
        die("Error executing query: " . $query->error);
    }

    // Close the query
    $query->close();

    // Subscription successful
    return true;
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'] ?? '';

    // Display received username for debugging
    echo "Received username: " . $username . "<br>";

    // Attempt to subscribe the user
    if (subscribeUser($con, $username)) {
        echo "<p style='color: #1DB954; text-align: center;'>Thank you, $username. You are now subscribed.</p>";
    } else {
        echo "<p style='color: #ff3333; text-align: center;'>Sorry, there was an error processing your subscription.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Paadu Gajala Payment Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #fff;
            padding: 40px;
        }
        .form-container {
            background-color: #181818;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            margin: auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border-radius: 4px;
            border: none;
            margin-top: 5px;
        }
        input[type="text"] {
            background-color: #333;
            color: #fff;
        }
        input[type="submit"] {
            background-color: #1DB954;
            color: black;
            font-weight: bold;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #1ED760;
        }
    </style>
</head>
<body>

<div class="form-container">
    <form id="subscription-form" method="post" novalidate>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="cardNumber">Card Number:</label>
            <input type="text" id="cardNumber" name="cardNumber" required pattern="\d{16}" placeholder="Enter 16-digit card number">
        </div>
        <div class="form-group">
            <label for="expiryDate">Expiry Date (MM/YY):</label>
            <input type="text" id="expiryDate" name="expiryDate" required pattern="\d{2}/\d{2}" placeholder="MM/YY">
        </div>
        <div class="form-group">
            <label for="securityCode">Security Code:</label>
            <input type="text" id="securityCode" name="securityCode" required pattern="\d{3}" placeholder="Enter 3-digit code">
        </div>
        <div class="form-group">
            <label for="nameOnCard">Name on Card:</label>
            <input type="text" id="nameOnCard" name="nameOnCard" required>
        </div>
        <input type="submit" value="Subscribe">
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('subscription-form');
        form.addEventListener('submit', function(event) {
            // Validate form fields
            const username = document.getElementById('username').value.trim();
            const cardNumber = document.getElementById('cardNumber').value.trim();
            const expiryDate = document.getElementById('expiryDate').value.trim();
            const securityCode = document.getElementById('securityCode').value.trim();
            const nameOnCard = document.getElementById('nameOnCard').value.trim();

            if (!(username && cardNumber && expiryDate && securityCode && nameOnCard)) {
                alert('Please fill out all required fields.');
                event.preventDefault();
            } else if (!cardNumber.match(/^\d{16}$/)) {
                alert('Please enter a valid 16-digit card number.');
                event.preventDefault();
            } else if (!expiryDate.match(/^\d{2}\/\d{2}$/)) {
                alert('Please enter the expiry date in the format MM/YY.');
                event.preventDefault();
            } else if (!securityCode.match(/^\d{3}$/)) {
                alert('Please enter a valid 3-digit security code.');
                event.preventDefault();
            }
        });
    });
</script>

</body>
</html>
