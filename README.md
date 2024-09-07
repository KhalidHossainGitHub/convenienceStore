# E-Commerce: Convenience Store

The **E-Commerce: Convenience Store** is a fully functional online store built using **HTML**, **CSS**, **JavaScript**, **PHP**, **MySQL**, and **WampServer**. This program allows users to shop for specific items, view stock availability, and access additional services. It also includes a cart system that notifies users of their purchases, the quantity, and total cost, with checkout functionality. The backend system handles product inventory, stock updates, and user information through a MySQL database.

## Preview of Homepage

<p align="center">
  <img width="938" alt="image" src="https://github.com/user-attachments/assets/5e072962-fce9-4b58-8e7d-cfff49f82ce7">
</p>

## Project Overview

The E-Commerce Convenience Store offers:

- **Product Search and Filters**: Users can search for specific items using the filter bar.
- **Shopping Cart**: Tracks items added to the cart, displays the total cost, and allows users to checkout.
- **Inventory Management**: The backend tracks the number of items available in stock and updates when purchases are made.
- **Checkout System**: Stores user information and purchased items in the database during checkout.
- **Additional Services**: The website includes additional services like **passport picture bookings**.

## Database Structure

The project uses a MySQL database called `store` with the following tables:

- **checkout_info**: Stores information about customers' checkout data.
- **inventory**: Tracks the number of items still available in the store.
- **passport_picture_bookings**: Stores data related to additional service bookings.

## Technologies Used

- **HTML5**: For structuring the content of the website.
- **CSS3**: For styling the layout and user interface.
- **JavaScript**: For adding client-side interactivity.
- **PHP**: For handling server-side logic and database interaction.
- **MySQL**: For managing and storing the product inventory, checkout data, and additional services.
- **WampServer**: Used as the local server environment for running the project.

## How to Run the Project

Follow these steps to set up and run the E-Commerce: Convenience Store project on your local machine:

### 1. Download the Project Files

1. https://github.com/KhalidHossainGitHub/convenienceStore.git
2. Click on the green **Code** button and select **Download ZIP**.
3. Extract the downloaded ZIP file.

### 2. Set Up WampServer

1. [Download and install WampServer](https://sourceforge.net/projects/wampserver/)
2. Once installed, open WampServer and ensure that the server is running (the WampServer icon should turn green in the system tray).

### 3. Set Up the Database

1. Open **phpMyAdmin** by navigating to `http://localhost/phpmyadmin/` in your browser.
2. Log in with your MySQL username and password (default username is `root`, and the password is usually blank if not set during installation).
3. Select the **Import** tab and select the `store.sql` file from the project directory.
4. Click **Import** to import the database structure and data.

### 4. Configure the Project 

1. Move the project files to the **www** directory of your WampServer installation (e.g., `C:\wamp64\www\convenienceStore`).
2. Open `simcoeconlin.php` and other PHP files to check if the MySQL database connection settings (hostname, username, password, database name) are correctly configured. Make sure the database name is set to `store`.

### 5. Run the Project

1. In your browser, go to `http://localhost/convenienceStore/simcoeconlin.php`.
2. You should now be able to browse the store, search for products, add items to the cart, and proceed to checkout.

