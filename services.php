<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Display the contents of the $_POST array for debugging
    var_dump($_POST);

    // Retrieve form data
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phoneNumber = $_POST["phoneNumber"];
    $email = $_POST["email"];
    $bookingDate = $_POST["selectedDate"];
    $bookingTime = $_POST["selectedTime"];

    // Add your database connection code
    $servername = "localhost";
    $username = "sofe280";
    $password = "123456";
    $dbname = "store";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Inserting data into the database
    $sql = "INSERT INTO passport_picture_bookings (name, address, phoneNumber, email, bookingDate, bookingTime)
            VALUES ('$name', '$address', '$phoneNumber', '$email','$bookingDate', '$bookingTime')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the desired page after updating inventory
        header("Location: http://localhost/convenienceStore/simcoeconlin.php");
        exit();}

    $conn->close();
}
?>

<!DOCTYPE html>
<head>
    <title>Simcoe Convenince Services</title>
    <link href="services.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <!-- Set up nav bar like the other pages -->
    <header>
        <div id="logoline">
            <img src="images/logo.jpg" alt="Store Logo">
            <h1>Simcoe-Conlin Convenience</h1>
        </div>
        <nav>
            <a href="simcoeconlin.php">Shop</a>
            <div class="dropdown">
                <!-- Different links so that the toggleDropdown can switch to where the user wants to go -->
                <a class="active" href="#services" onclick="toggleDropdown()">Services</a>
                <div class="dropdown-content" id="servicesDropdown">
                    <a href="#key" onclick="changeService('key')">Key Copy</a>
                    <a href="#passport" onclick="changeService('passport')">Passport Pictures</a>
                    <a href="#greetingCard" onclick="changeService('greetingCard')">Greeting Cards</a>
                    <a href="#printAndFax" onclick="changeService('printAndFax')">Print and Fax</a>
                </div>
            </div>
            <a href="#cart">Cart</a>
        </nav>
    </header>
    <!-- Creating a div for each service so the format for all are the same -->
    <div class="service" id="key">
        <h3 class="serviceName">Key Copy</h3>
        <img src="images/keys.jpg" alt="Keys" class="product-image">
        <p>
            Make a duplicate a key for your car or home. The self-service kiosks allow you to easily copy keys within minutes. The cost vaires from $2.00 - $5.00 depending on the type of key it is copying and if designs are added to it.<br><strong>This services is only avalible in store</strong>.
        </p>
    </div>
    <div class="service" id="passport">
        <h3 class="serviceName">Passport Pictures</h3>
        <img src="images/passport.jpg" alt="Passport" class="product-image">
        <p>Get your passport pictures taken near you! There is a professional photographer that will make sure you have no issues getting your passport. Children's photos cost $10.99 and adult's photos are $15.99. You must book at least three days in advance.
            <br><Strong>Payments are in-store only.</Strong>
        <!-- To hide all the html until the user clicks book now -->
            <details>
            <br>
            <summary>Book Now!</summary>
            <!-- divs and classes for the javascript to create the elements and styling -->
            <div class="calender-timeslot-container">
                <div class="calendar" id="calendar"></div>
                <div id="timeSlots">
                    <h2 id="timeslots-header"></h2>
                    <table id="timeslots-table" class="time-slots-table"></table>
                </div>
            </div>
            <!-- creating a popup form for when the user wants to book a timeslot -->
            <div class="popup-container" id="popupContainer">
            <form id="form" method="post" action="services.php">
                <input type="hidden" name="selectedDate" id="selectedDateInput">
                <input type="hidden" name="selectedTime" id="selectedTimeInput">
                <div class="popup-content">
                    <label for="nameInput">Name:</label>
                    <input type="text" name="name" id="nameInput" placeholder="First Last">
                    <label for="addressInput">Address:</label>
                    <input type="text" name="address" id="addressInput" placeholder="123 streetname">
                    <label for="phoneNumberInput">Phone Number:</label>
                    <input type="tel" name="phoneNumber" id="phoneNumberInput" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890">
                    <label for="emailInput">Email Address:</label>
                    <input type="email" name="email" id="emailInput" placeholder="name@domain.com">
                    <button type="submit" id="submitButton" onclick=showSchedulePopup()>Submit</button>
                </div>
            </form>
            </div>
        </details>
        <script>
            // Arrays used to generate the calendar
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            const weekdays = ['Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'];
            let calendarNumbers = []; // Creates an array used for ensuring the correct month is being displayed for the day selected
            document.getElementById('calendar').addEventListener('click', handleDateSelection); //Checking for date selection

            //To generate the calendar
            let selectedDate = new Date();
            generateCalendar();

            function generateCalendar() {
                let today = new Date();
                let startDate = new Date(today);
                startDate.setDate(today.getDate() - today.getDay()); // Start from the current week's Sunday
                let endDate = new Date(startDate);
                endDate.setDate(endDate.getDate() + 27); // Show four weeks (28 days)
                let bookingDate = new Date(today);
                bookingDate.setDate(bookingDate.getDate() + 3);

                let calendar = document.getElementById('calendar');
                calendar.innerHTML = ''; // Clear existing content

                // Add the month header
                let monthHeader = document.createElement('div');
                monthHeader.className = 'month-header';
                monthHeader.textContent = getMonthHeader(startDate, endDate);
                calendar.appendChild(monthHeader);

                // Add the weekdays row
                let weekdaysRow = document.createElement('div');
                weekdaysRow.className = 'weekdays-row';

                for (let i = 0; i < 7; i++) {
                    let day = document.createElement('div');
                    day.className = 'day';
                    day.textContent = weekdays[i];
                    weekdaysRow.appendChild(day);
                }
                calendar.appendChild(weekdaysRow);
                let currentDate = new Date(startDate);

                while (currentDate <= endDate) {
                    let row = document.createElement('div');
                    row.className = 'calendar-row';
                    for (let j = 0; j < 7; j++) {
                        let day = document.createElement('div');
                        day.className = 'date';
                        if (currentDate >= startDate && currentDate <= endDate) {
                            day.textContent = currentDate.getDate();

                            // Add the number to the calendarNumbers array
                            calendarNumbers.push(currentDate.getDate());

                            if (currentDate.toDateString() === today.toDateString()) {
                                day.classList.add('date-today');
                            }

                            // Highlight the selected date
                            if (currentDate.toDateString() === selectedDate.toDateString()) {
                                day.classList.add('date-selected');
                            }

                            // Grey out days before current day + 3 and disable scheduling
                            if (currentDate < bookingDate) {
                                day.classList.add('date-disabled');
                                day.addEventListener('click', function (event) {
                                    event.preventDefault(); // Prevent click action on disabled days
                                });
                            } else {
                                // Enable scheduling for valid days
                                day.addEventListener('click', handleDateSelection);
                            }
                        } else {
                            day.textContent = '';
                        }
                        row.appendChild(day);
                        currentDate.setDate(currentDate.getDate() + 1);
                    }
                    calendar.appendChild(row);
                }
                generateTimeSlotsTable(selectedDate);
            }
            //Getting the month header
            function getMonthHeader(startDate, endDate) {
                const startMonth = months[startDate.getMonth()];
                const endMonth = months[endDate.getMonth()];

                if (startMonth === endMonth) {
                    return startMonth;
                } else {
                    return `${startMonth} - ${endMonth}`;
                }
            }

            function handleDateSelection(event) {
                const clickedDate = event.target.textContent;

                if (!isNaN(clickedDate)) {
                    const newSelectedDate = new Date(selectedDate);
                    newSelectedDate.setDate(clickedDate);
                    selectedDate = newSelectedDate;
                    generateCalendar();
                }
            }

            //To create the button for all different timeslots
            function generateTimeSlotsTable(selectedDate) {
                const timeslotsTable = document.getElementById('timeslots-table');
                const timeslotsHeader = document.getElementById('timeslots-header');

                // Clear existing content
                timeslotsTable.innerHTML = '';

                // Set the header to match the selected date. If the index is before, then it is the first month, else, it is the second
                const cutoff = calendarNumbers.indexOf(1);

                if (calendarNumbers.indexOf(selectedDate.getDate()) < cutoff) {
                    selectedDate.setMonth(selectedDate.getMonth() - 1);
                    timeslotsHeader.textContent = formatDate(selectedDate);
                    selectedDate.setMonth(selectedDate.getMonth() + 1);
                } else {
                    timeslotsHeader.textContent = formatDate(selectedDate);
                }

                //only generates for valid days
                if (!selectedDate || calendarNumbers.indexOf(selectedDate.getDate()) <= calendarNumbers.indexOf(new Date().getDate() + 2)) {
                    // Display message for days without buttons
                    const messageRow = document.createElement('tr');
                    const messageCell = document.createElement('td');
                    messageCell.colSpan = 2;
                    messageCell.textContent = "Booking must be made at least three days in advance.";
                    messageRow.appendChild(messageCell);
                    timeslotsTable.appendChild(messageRow);

                    return; // Do not generate timeslots for disabled dates
                }

                const isWeekend = [0, 6].includes(selectedDate.getDay());//checking to see if the day is a weekend
                const startTime = isWeekend ? 9 : 12;//different start and end times based on a weekend or weekday
                const endTime = isWeekend ? 16 : 19;

                //Generate the timeslots
                const timeSlotHeaderRow = document.createElement('tr');
                const timeSlotHeader = document.createElement('th');
                timeSlotHeader.colSpan = 2;
                if (calendarNumbers.indexOf(selectedDate.getDate()) < cutoff) {
                    selectedDate.setMonth(selectedDate.getMonth() - 1);
                    timeSlotHeader.textContent = 'Time Slots for ' + formatDate(selectedDate);
                    selectedDate.setMonth(selectedDate.getMonth() + 1);
                } else {
                    timeSlotHeader.textContent = 'Time Slots for ' + formatDate(selectedDate);
                }
                timeSlotHeaderRow.appendChild(timeSlotHeader);
                timeslotsTable.appendChild(timeSlotHeaderRow);

                //print out slots
                for (let i = startTime; i <= endTime; i++) {
                    const timeSlotRow = document.createElement('tr');
                    const timeSlotTime = document.createElement('td');

                    // Convert 24-hour format to 12-hour format
                    const timeSlotStartTime = (i % 12 === 0) ? 12 : i % 12;
                    const timeSlotEndTime = ((i + 1) % 12 === 0) ? 12 : (i + 1) % 12;

                    timeSlotTime.textContent = `${timeSlotStartTime}:00 ${i < 12 ? 'AM' : 'PM'} - ${timeSlotEndTime}:00 ${i + 1 < 12 ? 'AM' : 'PM'}`;
                    timeSlotRow.appendChild(timeSlotTime);

                    const timeSlotButtonCell = document.createElement('td');
                    const scheduleButton = document.createElement('button');
                    scheduleButton.id = `scheduleButton_${selectedDate.getDate()}_${i}`; // Add an ID to identify the button
                    scheduleButton.className = 'schedule-button';
                    scheduleButton.textContent = 'Schedule';

                    //to input the slected date and time into the form
                    scheduleButton.addEventListener('click', function () {
                        const time = document.getElementById("selectedDateInput");
                        const date = document.getElementById("selectedTimeInput");
                        const year = selectedDate.getFullYear();
                        const month = String(selectedDate.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
                        const day = String(selectedDate.getDate()).padStart(2, '0');

                        // Create the formatted date string in YYYY-MM-DD format
                        const formattedDate = `${year}-${month}-${day}`;

                        time.value =formattedDate;
                        date.value = i;

                        //Make the popup show
                        const popup = document.getElementById("popupContainer");
                        popup.classList.remove("popup-container");
                        popup.classList.add("popup-container-show");
                    });
                    timeSlotButtonCell.appendChild(scheduleButton);
                    timeSlotRow.appendChild(timeSlotButtonCell);
                    timeslotsTable.appendChild(timeSlotRow);
                }
            }
            
            function formatDate(date) {
                const month = months[date.getMonth()];
                const day = date.getDate();
                return `${month} ${day}`;
            }
            const popupContent = document.createElement('div');

            //What happens when someone submits the form
            function showSchedulePopup(selectedDate, selectedTime) {
                const popupContainer = document.getElementById('popupContainer');
                popupContainer.classList.remove("popup-container-show");
                popupContainer.classList.add("popup-container");

                // Set the values of hidden inputs
                const selectedDateInput = document.getElementById('selectedDateInput');
                const selectedTimeInput = document.getElementById('selectedTimeInput');
                selectedDateInput.value = selectedDate.toISOString().split('T')[0];
                selectedTimeInput.value = selectedTime;

                // Attach the event listener to the form submission
                const formElement = document.getElementById('form');
                formElement.addEventListener('submit', function (event) {
                    event.preventDefault(); // Prevent the default form submission

                    // Validate form fields
                    const nameInput = document.getElementById('nameInput');
                    const addressInput = document.getElementById('addressInput');
                    const phoneNumberInput = document.getElementById('phoneNumberInput');
                    const emailInput = document.getElementById('emailInput');

                    submitForm();
                });

                function submitForm() {
                    // Sample AJAX request
                    const xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                console.log('Form submitted successfully');
                                // Handle success response
                            } else {
                                console.log('Form submission failed');
                                // Handle error response
                            }
                        }
                    };

                    xhr.open('POST', 'service.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.send(`selectedDate=${selectedDateInput.value}&selectedTime=${selectedTimeInput.value}&name=${nameInput.value}&address=${addressInput.value}&phoneNumber=${phoneNumberInput.value}&email=${emailInput.value}`);
                }
            }
            </script>
        </p>
    </div>
    <div class="service" id="greetingCard">
        <h3 class="serviceName">Greeting Cards</h3>
        <img src="images/card.jpg" alt="Greeting Card" class="product-image">
        <p>
            Choose a card for any occasion from your friend's birthday to a christmas card for your grandparents. There is a huge selection and write a custom note in the card. The price of the card varies from $1.00 to $5.00 with an additional cost of $2.50 for the custom note written inside.<br><strong>This services is only avalible in store</strong>.
        </p>
    </div>
    <div class="service" id="printAndFax">
        <h3 class="serviceName">Print and Fax</h3>
        <img src="images/print.jpg" alt="Print" class="product-image">
        <p>
            Print or fax documents in store. Printing is $0.10 per page and $0.15 for printing in colour. To send a fax, it costs $1.80 per page and $1.50 to recieve a fax.<br><strong>This services is only avalible in store</strong>.
        </p>
    </div>
</body>
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
</html>