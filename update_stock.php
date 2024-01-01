<?php
    // Establishing a connection to the database
    $servername = "localhost";
    $username = "sofe280";
    $password = "123456";
    $dbname = "store";

    $conn = new mysqli($servername, $username, $password, $dbname); // Creating a new MySQLi connection

    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error); // If connection fails, print the error message
    }

    // Retrieve the product name and quantity from the checkout page
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $productName = $_POST['product'];
        $quantity = $_POST['quantity'];

        // Update the inventory in the database after subtracting the reserved quantities
        $sql = "UPDATE inventory SET quantity = quantity - $quantity WHERE product_name = '$productName'";

        if ($conn->query($sql) === TRUE) {
            echo "Stock updated successfully";
            // Redirect to the desired page after updating inventory
            header("Location: http://localhost/convenienceStore/simcoeconlin.php");
            exit();
        } else {
            echo "Error updating stock: " . $conn->error;
        }
    }
    $conn->close();
?>