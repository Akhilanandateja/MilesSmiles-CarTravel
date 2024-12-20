
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1b91071d81.js" crossorigin="anonymous"></script>
    <title>Car Booking System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .custom-footer {
                     margin-top: auto; /* Push footer to the bottom of the page */
            width: 100%;
            background-color: black;
            color: white;
            padding: 20px 0;
        }

        .custom-footer .container {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .custom-footer .column {
            flex: 1;
            min-width: 200px;
            margin: 10px;
            padding: 0 20px;
        }

        .custom-footer .column h2, .custom-footer .column h3 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .custom-footer .column p, .custom-footer .column ul {
            margin: 10px 0;
            padding: 0;
            list-style: none;
        }

        .custom-footer .column ul li {
            margin: 5px 0;
        }

        .custom-footer .column ul li a {
            color: whitesmoke;
            text-decoration: underline;
        }

        .custom-footer .column ul li a:hover {
            color: #FF4C4C;
        }

        .custom-footer .footer-bottom {
            text-align: center;
            padding-top: 10px;
            border-top: 1px solid #fff;
            margin-top: 20px;
        }

        i {
            color: #FF4C4C;
            font-size: 20px;
        }

        @media (max-width: 600px) {
            .custom-footer .container {
                flex-direction: column;
                align-items: center;
            }

            .custom-footer .column {
                text-align: center;
                padding: 0;
            }
        }
        .p1{
            color:#FF4C4C;
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</head>
<body>
    <footer class="custom-footer">
        <div class="container">
            <div class="column">
                <h2>
                    <video width="200" height="100" autoplay loop muted>
                        <source src="images/ms3.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </h2>
            </div>
            <div class="column">
                <h3>INFORMATION</h3>
                <ul>
                    <li><a href="homepage.php">Home</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="book_cars.php">Bookings</a></li>
                    <li><a href="profile.php">View Profile</a></li>
                </ul>
            </div>
            <div class="column">
                <h3>SOCIAL MEDIA LINKS</h3><br>
                <ul>
                    <li>
                        <i class="fa-brands fa-whatsapp"></i>&nbsp&nbsp&nbsp&nbsp
                        <i class="fa-brands fa-instagram"></i>&nbsp&nbsp&nbsp&nbsp
                        <i class="fa-brands fa-facebook-f"></i>&nbsp&nbsp&nbsp
                        <i class="fa-brands fa-x-twitter"></i>&nbsp&nbsp&nbsp&nbsp
                        <i class="fa-brands fa-youtube"></i>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <footer class="custom-footer">
        <div class="footer-bottom">
            <p>&copy; 2024 Miles & Smiles. All rights reserved.</p>
            <p class="p1">Designed By - Sanga Akhilanandateja.</p>
        </div>
    </footer>
</body>
</html>
