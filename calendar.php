<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Booking System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding-top: 70px; /* Adjusted padding for header height */
            padding-bottom: 50px; /* Adjusted padding for footer height */
        }

        .booking-container {
            background: url('images/1234.png') no-repeat center center;
            background-size: cover;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 70%;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .booking-section {
            text-align: center;
            flex: 1;
            margin: 0 10px;
        }

        .booking-section label {
            color: #FF4C4C;
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .booking-section input, .booking-section select {
            width: 80%;
            padding: 10px;
            border: 2px solid black;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 10px;
        }

        .booking-section button {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            background-color: #FF4C4C;
            color: white;
            border: none;
            position: relative;
            overflow: hidden;
            transition: color 0.4s;
        }

        .booking-section button:before {
            content: "Book Now";
            align-content: center;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: black;
            z-index: 0;
            transform: translateX(-100%);
            transition: transform 0.4s;
        }

        .booking-section button:hover:before {
            transform: translateX(0);
        }

        .booking-section button:hover {
            background-color: black;
            text-decoration-skip: white;
        }

        .booking-section button:disabled {
            background-color: #FF4C4C;
            cursor: not-allowed;
        }

        .passenger-controls {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .passenger-controls input {
            width: 50px;
            text-align: center;
            margin: 0 5px;
        }

        .passenger-controls span {
            color: #007bff;
            font-size: 20px;
            cursor: pointer;
            margin: 0 5px;
        }

        .datepicker-container {
            position: relative;
            width: 100%;
        }

        .datepicker-container input {
            padding-left: 30px;
        }

        .datepicker-container .icon {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #007bff;
        }

        .button-section {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        a {
            cursor: pointer;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: black;
            z-index: 1000;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: black;
            color: white;
            text-align: center;
            padding: 10px 0;
            z-index: 1000;
        }

        .footer-bottom {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #fff;
        }
    </style>
</head>
<body>
    <div class="booking-container">
        <form action="calendar_bookings.php" method="post" style="display: flex; width: 100%; justify-content: space-between;">
            <div class="booking-section">
                <label for="location">📍Location</label>
                <select id="location" name="location" required>
                    <option value="" selected disabled>Popular cities</option>
                    <option value="Hyderabad">Hyderabad</option>
                    <option value="Amaravati">Amaravati</option>
                    <option value="Vizag">Vizag</option>
                    <option value="Chennai">Chennai</option>
                    <option value="Mumbai">Mumbai</option>
                    <option value="Bengaluru">Bengaluru</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Kashmir">Kashmir</option>
                    <option value="Kanyakumari">Kanyakumari</option>
                    <option value="Jaipur">Jaipur</option>
                    <option value="Ayodhya">Ayodhya</option>
                    <option value="" selected disabled>Some famous Tourist places</option>
                    <option value="Kodaicanal">Kodaicanal</option>
                    <option value="Araku">Araku</option>
                    <option value="Ooty">Ooty</option>
                    <option value="Ladak">Ladak</option>
                    <option value="" selected disabled>cities</option>
                    <option value="warangal">warangal</option>
                    <option value="Karimnagar">Karimnagar</option>
                    <option value="Guntur">Guntur</option>
                    <option value="Tirupati">Tirupati</option>
                </select>
            </div>
            <div class="booking-section">
                <label for="passengers">👥Travellers</label>
                <div class="passenger-controls">
                    <span id="decrement">-</span>
                    <input type="text" id="passengers" name="passengers" value="4" readonly required>
                    <span id="increment">+</span>
                </div>
            </div>
            <div class="booking-section datepicker-container">
                <label for="arrival">🗓️Start</label>
                <input type="text" id="arrival" name="start_date" readonly required placeholder="Choose date">
            </div>
            <div class="booking-section datepicker-container">
                <label for="departure">🗓️Departure</label>
                <input type="text" id="departure" name="departure_date" readonly required placeholder="Choose date">
            </div>
            <div class="booking-section button-section">
                <button type="submit" name="book" id="book">Book Now</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize datepickers
            $("#arrival, #departure").datepicker({
                dateFormat: "dd-mm-yy"
            });

            // Handle passenger count increment/decrement
            $("#increment").click(function() {
                let count = parseInt($("#passengers").val());
                $("#passengers").val(count + 1);
            });

            $("#decrement").click(function() {
                let count = parseInt($("#passengers").val());
                if (count > 1) {
                    $("#passengers").val(count - 1);
                }
            });
        });
    </script>
</body>
</html>
