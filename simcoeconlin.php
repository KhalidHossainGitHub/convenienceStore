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

    // Retrieve the stock level based on the product name from the database
    $sql = "SELECT product_name, quantity FROM inventory WHERE product_name
    IN ('Pringles', 'Hershey Bar', 'Lays Chips', 'Coca-Cola', 'Red Bull', 'Sparkling Water', 'iPhone Charger', 'Cigarettes', 'Chapstick')";

    $result = $conn->query($sql); // Execute the SQL query
    $quantity = array(); // Initializing an array to store quantities
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $quantity[$row['product_name']] = $row['quantity']; // Storing quantities by product name
        }
    }

    // Storing all the items in an array
    $items = array(
        'Pringles', 'Hershey Bar', 'Lays Chips', 'Coca-Cola',
        'Red Bull', 'Sparkling Water', 'iPhone Charger', 'Cigarettes', 'Chapstick'
    );

    // Populate stock for missing items
    foreach ($items as $item) {
        if (!isset($quantity[$item])) {
            $quantity[$item] = 'Stock not available'; // Setting stock as 'Stock not available' for missing items
        }
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Convenience Store</title>
        <link rel="stylesheet" href="simcoeconlin.css">
    </head>
    <body>
        <header>
            <!-- A heading with the logo and the store name-->
            <div id="logoline">
                <img src="images/logo.jpg" alt="Store Logo">
                <h1>Simcoe-Conlin Convenience</h1>
            </div>

            <!-- A navbar showing different pages of the website-->
            <nav>
                <a class="active" href="#shop">Shop</a>
                <a href="services.php">Services</a>
                <a href="#cart" id="cartLink">Cart</a>
            </nav>
        </header>
        <main>
            <!-- A filter section to filter items based on different categories -->
            <div class="filters">
                <h2>Filters</h2>
                <label>
                    <input type="checkbox" name="filter-food">Food
                </label>
                <label>
                    <input type="checkbox" name="filter-drink">Drinks
                </label>
                <label>
                    <input type="checkbox" name="filter-other">Other
                </label>
            </div>

            <div id="products">
                <div class="product">
                    <div class="product-container">
                        <img src="images/pringle.jpg" alt="Pringles Image" class="product-image pringlesPack-image">
                        <h2 class="product-name food">Pringles</h2>
                        <p class="product-price" id="pringles-price">$2.49</p>
                        <!-- Quantity is accessed from the database -->
                        <p class="stock-inventory" id="stock-inventory">Stock: <?php echo $quantity['Pringles']; ?></p>
                        <label for="totalitem1" id="totalitem">No. of Items: </label>
                        <input type="number" min="0" max="5" name="Pringles" id="totalitem1" placeholder="0"><br>
                        <button class="add-button" id="addToCartButton1">Add to Cart</button>
                    </div>
                </div>

                <div class="product">
                    <div class="product-container">
                        <img src="images/hershey.jpg" alt="Hershey Bar Image" class="product-image hersheyChocolate-image">
                        <h2 class="product-name food">Hershey Bar</h2>
                        <p class="product-price" id="hershey-bar-price">$2.29</p>
                        <!-- Quantity is accessed from the database -->
                        <p class="stock-inventory" id="hershey-bar-inventory">Stock: <?php echo $quantity['Hershey Bar']; ?></p>
                        <label for="totalitem2" id="totalitem">No. of Items: </label>
                        <input type="number" min="0" max="5" name="Hershey Bar" id="totalitem2" placeholder="0"><br>
                        <button class="add-button" id="addToCartButton2">Add to Cart</button>
                    </div>
                </div>

                <div class="product">
                    <div class="product-container">
                        <img src="images/lays.jpg" alt="Lays Chips Image" class="product-image">
                        <h2 class="product-name food">Lays Chips</h2>
                        <p class="product-price" id="lays-chips-price">$4.49</p>
                        <!-- Quantity is accessed from the database -->
                        <p class="stock-inventory" id="lays-chips-inventory">Stock: <?php echo $quantity['Lays Chips']; ?></p>
                        <label for="totalitem3" id="totalitem">No. of Items: </label>
                        <input type="number" min="0" max="5" name="Lays Chips" id="totalitem3" placeholder="0"><br>
                        <button class="add-button" id="addToCartButton3">Add to Cart</button>
                    </div>
                </div>

                <div class="product">
                    <div class="product-container">
                        <img src="images/coke.jpg" alt="Coca-Cola Image" class="product-image">
                        <h2 class="product-name drink">Coca-Cola</h2>
                        <p class="product-price" id="coca-cola-price">$1.99</p>
                        <!-- Quantity is accessed from the database -->
                        <p class="stock-inventory" id="coca-cola-inventory">Stock: <?php echo $quantity['Coca-Cola']; ?></p>
                        <label for="totalitem4" id="totalitem">No. of Items: </label>
                        <input type="number" min="0" max="5" name="Coca-Cola" id="totalitem4" placeholder="0"><br>
                        <button class="add-button" id="addToCartButton4">Add to Cart</button>
                    </div>
                </div>

                <div class="product">
                    <div class="product-container">
                        <img src="images/redbull.jpg" alt="Red Bull Image" class="product-image">
                        <h2 class="product-name drink">Red Bull</h2>
                        <p class="product-price" id="redbull-price">$3.99</p>
                        <!-- Quantity is accessed from the database -->
                        <p class="stock-inventory" id="redbull-inventory">Stock: <?php echo $quantity['Red Bull']; ?></p>
                        <label for="totalitem5" id="totalitem">No. of Items: </label>
                        <input type="number" min="0" max="5" name="Red Bull" id="totalitem5" placeholder="0"><br>
                        <button class="add-button" id="addToCartButton5">Add to Cart</button>
                    </div>
                </div>

                <div class="product">
                    <div class="product-container">
                        <img src="images/water.jpg" alt="Sparkling-Water Image" class="product-image">
                        <h2 class="product-name drink">Sparkling Water</h2>
                        <p class="product-price" id="Sparkling-water-price">$3.29</p>
                        <!-- Quantity is accessed from the database -->
                        <p class="stock-inventory" id="sparkling-water-inventory">Stock: <?php echo $quantity['Sparkling Water']; ?></p>
                        <label for="totalitem6" id="totalitem">No. of Items: </label>
                        <input type="number" min="0" max="5" name="Sparkling Water" id="totalitem6" placeholder="0"><br>
                        <button class="add-button" id="addToCartButton6">Add to Cart</button>
                    </div>
                </div>

                <div class="product">
                    <div class="product-container">
                        <img src="images/charger.jpg" alt="iPhone Charger Image" class="product-image">
                        <h2 class="product-name other">iPhone Charger</h2>
                        <p class="product-price" id="iphone-charger-price">$24.99</p>
                        <!-- Quantity is accessed from the database -->
                        <p class="stock-inventory" id="iphone-charger-inventory">Stock: <?php echo $quantity['iPhone Charger']; ?></p>
                        <label for="totalitem7" id="totalitem">No. of Items: </label>
                        <input type="number" min="0" max="5" name="iphone Charger" id="totalitem7" placeholder="0"><br>
                        <button class="add-button" id="addToCartButton7">Add to Cart</button>
                    </div>
                </div>

                <div class="product">
                    <div class="product-container">
                        <img src="images/cigarettePack.jpg" alt="Cigarettes Image" class="product-image">
                        <h2 class="product-name other">Cigarettes</h2>
                        <p class="product-price" id="cigarettes-price">$19.99</p>
                        <!-- Quantity is accessed from the database -->
                        <p class="stock-inventory" id="cigarettes-inventory">Stock: <?php echo $quantity['Cigarettes']; ?></p>
                        <label for="totalitem8" id="totalitem">No. of Items: </label>
                        <input type="number" min="0" max="5" name="Cigarettes" id="totalitem8" placeholder="0"><br>
                        <button class="add-button" id="addToCartButton8">Add to Cart</button>
                    </div>
                </div>

                <div class="product">
                    <div class="product-container">
                        <img src="images/chapstick.jpg" alt="Chapstick Image" class="product-image">
                        <h2 class="product-name other">Chapstick</h2>
                        <p class="product-price" id="chapstick-price">$5.99</p>
                        <!-- Quantity is accessed from the database -->
                        <p class="stock-inventory" id="chaptick-inventory">Stock: <?php echo $quantity['Chapstick']; ?></p>
                        <label for="totalitem9" id="totalitem">No. of Items: </label>
                        <input type="number" min="0" max="5" name="Chapstick" id="totalitem9" placeholder="0"><br>
                        <button class="add-button" id="addToCartButton9">Add to Cart</button>
                    </div>
                </div>
            </div>
        </main>

        <!-- Aside element is hidden unless the Cart in the navbar is clicked -->
        <aside id="cart-nav" class="hidden">
            <!-- Cart navigation content goes here -->
            <div class="cart-head">
                <h2>Cart</h2>
            </div>
            <div id="cart-items">
                <!-- Cart items will be displayed here -->
            </div>
            <div id="cart-summary">
                <!-- Cart summary (total, checkout button, etc.) -->
                <p>Total items: <span id="total-items">0</span></p>
                <p>Total price: <span id="total-price">$0.00</span></p>
                <button id="checkout-button">Checkout</button>
                <button id="closeCart">Close</button>
            </div>
        </aside>

        <!-- A Footer Section -->
        <footer>
            <div class="about-section">
                <h2>About Us</h2>
                <p>Simcoe-Conlin Convenience is your one-stop shop for all your convenience store needs. We offer a wide range of products to make your life easier.</p>
            </div>
            <div class="hours">
                <h2>Store Hours</h2>
                <p>Monday-Friday: 8:00 AM - 9:00 PM</p>
                <p>Saturday-Sunday: 9:00 AM - 7:00 PM</p>
            </div>
            <div class="copyright">
                <p>&copy; 2023 Simcoe-Conlin Convenience</p>
            </div>
        </footer>

        <!-- Script -->
        <script>
            // Adding event listener to wait for the DOM content to be loaded
            document.addEventListener('DOMContentLoaded', function () {
        
            // Accessing all the information from the html and storing in a variable
            const checkboxes = document.querySelectorAll('.filters input[type="checkbox"]');
            const products = document.querySelectorAll('.product');
            const cartNav = document.getElementById('cart-nav');
            const cartLink = document.getElementById('cartLink');
            const cartItems = document.getElementById('cart-items');
            const totalItems = document.getElementById('total-items');
            const totalPrice = document.getElementById('total-price');


            // Getting the close button when cart is displayed
            const closeCartButton = document.getElementById('closeCart');
            closeCartButton.addEventListener('click', function(){
                cartNav.classList.remove('visible');
            });

            let cart = []; // Array to hold cart items
            // New code for adding items to the cart
            const addToCartButtons = document.querySelectorAll('.add-button');

            // Function to add items to cart and it iterates through each product
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const productName = button.parentNode.querySelector('.product-name').textContent;
                    const productPrice = parseFloat(button.parentNode.querySelector('.product-price').textContent.replace('$', ''));
                    const quantityInput = button.parentNode.querySelector('input[type="number"]');
                    if(quantityInput){
                        const quantity = parseInt(quantityInput.value) || 0;
                        addToCart(productName, productPrice, quantity);
                    }
                    else{
                        console.log('Quantity input not found.');
                    }
                });
            });

            // Function to handle adding items to the cart
            function addToCart(name, price, quantity) {
                const totalPrice = price * quantity;
                if(quantity > 0){
                    cart.push({ name, price: totalPrice, quantity }); // Store name, total price, and quantity in the cart array
                    localStorage.setItem('cartItems', JSON.stringify(cart));
                    updateCart();
                }
                else{
                    console.log('Please enter a valid quantity.');
                }
            }

            // Function to toggle the aside element
            function toggleCart() {
                cartNav.classList.toggle('visible');
                updateCart(); // Update the cart when it's displayed
            }

            // Event listener for the Cart link in the navbar
            cartLink.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent default link behavior
                toggleCart(); // Toggle cart visibility
            });
            
            // Function to send the quantities reserved in the cart to update the stock level in the database
            function updateStock(productName, quantity){
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function (){
                    if(xhr.readyState === XMLHttpRequest.DONE){
                        if(xhr.status === 200){
                            console.log('Stock updated successfully!');
                        }
                        else{
                            console.log('Failed to update stock.');
                        }
                    }
                };
                xhr.open('POST', 'update_stock.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send(`product=${productName}&quantity=${quantity}`);
            }

            function updateCartDisplay() {
                const cartItemsContainer = document.getElementById('cart-items');
                const totalItems = document.getElementById('total-items');
                const totalPrice = document.getElementById('total-price');

                cartItemsContainer.innerHTML = ''; // Clear previous cart items
                let total = 0; // Initialize total to calculate the sum of prices
                let totalItemsCount = 0; // Initialize total items count

                cart.forEach(item => {
                    const cartItem = document.createElement('div');
                    cartItem.classList.add('cart-item'); // Add a class for styling purposes

                    const itemName = document.createElement('span');
                    itemName.textContent = item.name;

                    const itemPrice = document.createElement('span');
                    itemPrice.textContent = '$' + item.price.toFixed(2);

                    cartItem.appendChild(itemName);
                    cartItem.appendChild(itemPrice);
                    cartItemsContainer.appendChild(cartItem);

                    total += item.price; // Accumulate item prices to calculate total
                    totalItemsCount += item.quantity; // Accumulate item quantities to calculate total items count
                });


                // Calculate tax based on the total
                const taxRate = 0.13;
                const tax = total * taxRate;
                const totalPriceWithTax = total + tax;

                // Display the total number of items and total price in the cart
                totalItems.textContent = totalItemsCount;
                totalPrice.textContent = '$' + totalPriceWithTax.toFixed(2);
            }

            // Event listener for the Checkout button
            const checkoutButton = document.getElementById('checkout-button');
            checkoutButton.addEventListener('click', function () {
                updateStockQuantities(); // Update quantities in the database
                localStorage.setItem('cartItems', JSON.stringify(cart));
                window.location.href = 'http://localhost/convenienceStore/checkout.php'; // Redirect to checkout
            });

            function updateStockQuantities() {
                products.forEach(product => {
                    const productName = product.querySelector('.product-name').textContent;
                    const quantityInput = product.querySelector('input[type="number"]');
                
                    if (quantityInput) {
                        const quantity = parseInt(quantityInput.value) || 0;
                        updateStock(productName, quantity);
                    } else {
                        console.log(`Quantity input not found for ${productName}.`);
                    }
                });
            }

            function updateCart(){
                updateCartDisplay();
            }
            updateCart();
        
            // Function to filter products based on checkboxes
            function filterProducts() {
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function () {
                        const checkedFilters = Array.from(checkboxes)
                        .filter(cb => cb.checked)
                        .map(cb => cb.name.replace('filter-', ''));

                        products.forEach(product => {
                            const productCategory = product.querySelector('.product-name').classList;
                            if (checkedFilters.length === 0 || checkedFilters.includes(productCategory[1])) {
                                product.style.display = 'block';
                            }
                            else {
                                product.style.display = 'none';
                            }
                        });
                    });
                });
            }
            filterProducts();
        });
        </script>
    </body>
</html>