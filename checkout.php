<?php
// Establish database connection
$servername = "localhost";
$username = "sofe280";
$password = "123456";
$dbname = "store";

// Create a new MySQLi database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the database connection is successful; if not, terminate the script and display an error message
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data and insert into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];

    // Example query to insert data into checkout_info table
    $sql = "INSERT INTO checkout_info (First_Name, Last_Name, Address, Phone_Number, Email) VALUES ('$firstName', '$lastName', '$address', '$phoneNumber', '$email')";

    // Check if the SQL query was successful, get the new customer ID, and determine the number of cart items
    if ($conn->query($sql) === TRUE) {
        $customerId = $conn->insert_id;
        $cartItemsCount = count($_POST) - 5;
        // Iterate through and insert cart items into 'product_details' for the customer
        for ($i = 0; $i < $cartItemsCount / 2; $i++) {
            $productName = $_POST["productName$i"];
            $productQuantity = $_POST["productQuantity$i"];
            // Insert into the 'product_details' table
            $sqlProducts = "INSERT INTO product_details (Customer_ID, Product_Name, Quantity)
                            VALUES ($customerId, '$productName', $productQuantity)";
            $conn->query($sqlProducts);
        }
        // Redirect to the desired page after updating inventory
        header("Location: http://localhost/convenienceStore/simcoeconlin.php");
        exit();
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// Close the database connection.
$conn->close();
?>

<!-- Define HTML structure with metadata and link external stylesheets -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convenience Store</title>
    <link rel="stylesheet" href="checkout.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body>
    <!-- Create a header with a logo and store name -->
    <header>
        <div id="logoline">
            <img src="images/logo.jpg" alt="Store Logo">
            <h1>Simcoe-Conlin Convenience</h1>
        </div>
    </header>
<br>

<!-- Include checkout information here -->
<div id="container">
    <!-- Main content with hidden cart summary, displaying items and total -->
    <div id="col1">
        <main>
            <div id="cart-nav" class="hidden">
                <!-- Cart navigation content goes here -->
                <div class="cart-head">
                    <h2>Cart Summary</h2>
                </div>
                <div id="cart-items">
                    <h4>Products List</h4>
                    <!-- Cart items will be displayed here -->
                </div>
                <hr>
                <div id="cart-summary">
                    <!-- Cart summary (total, checkout button, etc.) -->
                    <p>Total items: <span id="total-items">0</span></p>
                    <p>Total price: <span id="total-price">$0.00</span></p>
                </div>
            </div>
        </main>
    </div>
    <!-- Customer information form with fields and submit button -->
    <div id="col2">
        <aside>
            <form method="post" action="checkout.php">
                <h2>Customer Information</h2>
                <label>First Name: </label>
                <input type="text" name="firstName" placeholder="First Name"><br>
                <label>Last Name: </label>
                <input type="text" name="lastName" placeholder="Last Name"><br>
                <label>Address: </label>
                <input type="textarea" name="address" placeholder="123 StreetName"><br>
                <label>Phone Number: </label>
                <input type="tel" name="phoneNumber" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890"><br>
                <label>Email: </label>
                <input type="email" name="email" placeholder="name@domain.com"><br>
                <button type="submit">Submit</button>
            </form>
        </aside>
    </div>
</div>

    <script>
        // Calculate total function for a given subtotal and tax rate using JavaScript
        document.addEventListener('DOMContentLoaded', function() {
        function calculateTotal(subtotal, taxRate) {
            const tax = subtotal * (taxRate / 100);
            const total = subtotal + tax;
            return total.toFixed(2);
        }
    
        // Retrieve and reference cart items and HTML elements for display
        const cartItems = JSON.parse(localStorage.getItem('cartItems'));
        const cartItemsContainer = document.getElementById('cart-items');
        const totalItemsElement = document.getElementById('total-items');
        const totalPriceElement = document.getElementById('total-price');

        // Display cart items and calculate total
        if (cartItems && cartItems.length > 0) {
            // Initialize variables for total items and total price
            let totalItems = 0;
            let totalPrice = 0;

            // Iterate through cart items, create and append HTML elements for name and price
            cartItems.forEach(item => {
                const cartItem = document.createElement('div');
                cartItem.classList.add('cart-item');
                const itemName = document.createElement('span');
                itemName.textContent = item.name;
                const itemPrice = document.createElement('span');
                itemPrice.textContent = ': $ ' + item.price.toFixed(2);

                // Append item name and price to the cart, update total items and total price
                cartItem.appendChild(itemName);
                cartItem.appendChild(itemPrice);
                cartItemsContainer.appendChild(cartItem);

                totalItems += item.quantity;
                totalPrice += item.price;
            });

            // Create hidden form inputs for each cart item's name and quantity
            const form = document.querySelector('form');
            cartItems.forEach((item, index) => {
                const productNameInput = document.createElement('input');
                productNameInput.type = 'hidden';
                productNameInput.name = `productName${index}`;
                productNameInput.value = item.name;
                const productQuantityInput = document.createElement('input');
                productQuantityInput.type = 'hidden';
                productQuantityInput.name = `productQuantity${index}`;
                productQuantityInput.value = item.quantity;

                // Append to the form
                form.appendChild(productNameInput);
                form.appendChild(productQuantityInput);
            });

            totalItemsElement.textContent = totalItems;          
            // Calculate total including tax and display
            const taxRate = 13; // Replace with your actual tax rate
            const totalWithTax = calculateTotal(totalPrice, taxRate);
            totalPriceElement.textContent = '$' + totalWithTax;
        } else {
            cartItemsContainer.textContent = 'No items in the cart.';
        }
        });
    </script>
</body>
</html>