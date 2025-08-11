<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $nom = htmlspecialchars(trim($_POST['nom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate the inputs (basic validation)
    if (empty($nom) || empty($email) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Email setup
    $to = "tadmonyaya@gmail.com";  // Replace with your email
    $subject = "New Contact Form Message from $nom";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Message body
    $email_content = "Name: $nom\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Send email
    if (mail($to, $subject, $email_content, $headers)) {
        echo "Your message has been sent successfully.";
    } else {
        echo "There was an error sending your message. Please try again later.";
    }
} else {
    echo "Invalid request.";
}
?>
