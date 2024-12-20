<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/1b91071d81.js" crossorigin="anonymous"></script>
    <title>Contact Us</title>
    <style>
        body {
            background-color: black;
        }
        * {
            box-sizing: border-box;
        }

        /* Style inputs */
        .container input[type=text], .container select, .container textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
            color: black;
        }

        .container input[type=submit] {
            background-color: #FF4C4C;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
        }

        .container input[type=submit]:hover {
            background-color: black;
        }

        /* Style the container/contact section */
        .container {
            border-radius: 5px;
            background-color: none;
            padding: 10px;
        }

        /* Create two columns that float next to each other */
        .container .column {
            float: left;
            width: 50%;
            margin-top: 6px;
            padding: 20px;
        }

        /* Clear floats after the columns */
        .container .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .container .column, .container input[type=submit] {
                width: 100%;
                margin-top: 0;
            }
        }
        a {
            color: blue;
            text-decoration: none;
        }
        a:hover {
            color: #FF4C4C;
            text-decoration: underline;
        }
        label {
            color: #FF4C4C;
            font-weight: bold;
        }
        .about-section {
            display: flex;
            padding: 50px;
            text-align: center;
            background-image: url("images/road.png");
            height: 50%;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: bottom;
            background-repeat: no-repeat;
            color: black;
        }
        .about-section h1 {
            color: white;
            font-weight: bold;
        }
        h2 {
            color: white;
        }

        .contact-container {
            width:100%;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            padding: 30px;
            background-color: black;
        }

        .contact-card {
            background-color: #f0f0f0;
            border-radius: 8px;
            padding: 20px;
            width: calc(25.33% - 20px);
            text-align: center;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .icon {
            color:black;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .contact-info h3 {
            margin: 10px 0;
            color: #cc6600;
        }

        .contact-info p {
            margin: 5px 0;
            color: #333;
        }
        .contact-card i{
            color:#FF4C4C;
            font-size: 30px;
        }
        h1{
            color: white;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="about-section">
        <h1>We would love to hear it from you</h1>
    </div>
    <div class="container">
        <div style="text-align:center">
            <h2>Swing by our cars, or leave us a message:</h2>
            <p><a href="mailto:akhilanandatejasanga@gmail.com">Click here to send us an email directly</a></p>
        </div>
        <div class="row">
            <div class="column">
                <img src="images/india.png" style="width:100%">
            </div>
            <div class="column">
            <form action="https://api.web3forms.com/submit" method="POST">
                <input type="hidden" name="access_key" value="4eef91cc-df56-4349-917e-7f7632feb14d">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your name..">
                    <label for="number">Mobile Number</label>
                    <input type="text" id="lname" name="number" placeholder="Your mobile number..">
                    <label for="email">Email Address</label>
                    <input type="text" id="email" name="email" placeholder="Your email address..">
                    <label for="country">Country</label>
                    <select id="country" name="country">
                        <option value="India">India</option>
                        <option value="canada">Canada</option>
                        <option value="usa">USA</option>
                    </select>
                    <label for="message">Message</label>
                    <textarea name="userMessage" placeholder="Message.." id="userMessage" style="height:170px" required></textarea>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
<h1>Get In Touch With Us</h1>
<div class="contact-container">
    <div class="contact-card">
      <i class="fa-solid fa-location-dot"></i>
        <div class="contact-info">
            <h3>OUR MAIN OFFICE</h3>
            <p>Vizag</p>
        </div>
    </div>
    <div class="contact-card">
        <i class="fa-solid fa-phone"></i>
        <div class="contact-info">
            <h3>PHONE NUMBER</h3>
            <p>+91 8328632167</p>
            <p>888-0123-4567 (Toll Free)</p>
        </div>
    </div>
    <div class="contact-card">
       <i class="fa-solid fa-fax"></i>
        <div class="contact-info">
            <h3>FAX</h3>
            <p>1-234-567-8900</p>
        </div>
    </div>
    <div class="contact-card">
        <i class="fa-solid fa-envelope"></i>
        <div class="contact-info">
            <h3>EMAIL</h3>
            <p>travels@support.com</p>
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>

</body>
</html>

<?php include 'footer.php'; ?>
