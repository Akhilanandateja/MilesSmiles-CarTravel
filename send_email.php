<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = htmlspecialchars($_POST['first-name']);
    $lastName = htmlspecialchars($_POST['last-name']);
    $emailAddress = htmlspecialchars($_POST['email-address']);
    $message = htmlspecialchars($_POST['message']);

    // Email details
    $to = "akhilanandatejasanga@gmail.com"; // Replace with your email address
    $subject = "Contact Form Submission from $firstName $lastName";
    $headers = "From: $emailAddress\r\n";
    $headers .= "Reply-To: $emailAddress\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Email body
    $body = "You have received a new message from your website contact form.\n\n";
    $body .= "Here are the details:\n";
    $body .= "First Name: $firstName\n";
    $body .= "Last Name: $lastName\n";
    $body .= "Email: $emailAddress\n";
    $body .= "Message:\n$message\n";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Sorry, something went wrong. Please try again later.";
    }
}
?>
