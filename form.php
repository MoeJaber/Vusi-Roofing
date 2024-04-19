<?php
if (isset($_POST['submit'])) {
    $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
    $email = trim(strip_tags($_POST['email']));

    if (!preg_match($emailPattern, $email)) {
        echo "The email address you entered was invalid. Please try again!";
        exit;
    }

    // Prepare HTML email message
    $message = "<html><body>";
    $message .= "Vusi Roofing - Hi admin, you got a new query from your website.";
    $message .= "<table rules='all' style='border-color: #666;' cellpadding='10'>";
    $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['full_name']) . "</td></tr>";
    $message .= "<tr><td><strong>Email:</strong> </td><td>" . $email . "</td></tr>";
    $message .= "<tr><td><strong>Phone Number:</strong> </td><td>" . strip_tags($_POST['phone']) . "</td></tr>";
    $message .= "<tr><td><strong>Address:</strong> </td><td>" . strip_tags($_POST['address']) . "</td></tr>";
    $message .= "<tr><td><strong>Service required:</strong> </td><td>" . strip_tags($_POST['estimate']) . "</td></tr>";
    $message .= "<tr><td><strong>Message (Optional):</strong> </td><td>" . strip_tags($_POST['message']) . "</td></tr>";
    $message .= "</table>";
    $message .= "</body></html>";

    // Email headers
    $headers = "From: info@vusiroofing.com\r\n";
    $headers .= "Reply-To: noreply@vusiroofing.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    // Thank you email
    $thanksemail = $email;
    $message2 = "<html><body><p>Thank you for getting in touch!</p>
                 <p>We have received your message and would like to thank you for writing to us. If your inquiry is urgent, please call (613) 266-2014 to talk to one of our staff members.</p>
                 <p>Otherwise, we will reply by email as soon as possible.</p>
                 <p>Talk to you soon, Vusi Roofing</p></body></html>";

    if (mail('m10.jaber@gmail.com', 'Vusi Roofing', $message, $headers) && mail($thanksemail, 'Vusi Roofing', $message2, $headers)) {
        header('Location: index.php?msg=success');
    } else {
        header('Location: index.php?msg=fail');
    }
}
?>