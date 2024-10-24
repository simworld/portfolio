<?php

require_once 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and retrieve form data
    $name = htmlspecialchars($_POST["firstname"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $message = htmlspecialchars($_POST["message"]);

    // Validate form data 
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        // Handle form errors
        // echo "Please fill in all the required fields.";
        echo "<script>alert('Please fill in all the required fields!');window.location.href = '../index.html';</script>";
        exit;
    }


    // Compose the email message
    $to = RECIPIENT_EMAIL;
    $subject = "Contact Form Submission";
    $messageBody = "Hello,\n\n";
    $messageBody .= "You have received a new contact form submission from:\n\n";
    $messageBody .= "Name: $name\n";
    $messageBody .= "Email: $email\n";
    $messageBody .= "Phone: $phone\n";
    $messageBody .= "Message:\n$message\n";

    // Set additional headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    if (mail($to, $subject, $messageBody, $headers)) {
        // Email sent successfully 
        // echo "<script>alert('Message sent! Thank you for contacting us. We will get back to you soon.');window.location.href = 'thank-you.html';</script>";
        header("Location: thank-you.html"); 
        exit;
    } else {
        // Handle email sending errors (e.g., display an error message to the user)
        // echo "Error sending the email. Please try again later.";
        echo "<script>alert('Error sending the email. Please try again later.');window.location.href = 'contact.html';</script>";
        
        exit;
    }
}
?>
