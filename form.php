<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

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

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send through
        $mail->SMTPAuth = true;           // Enable SMTP authentication
		$mail->Username = 'm10.jaber@gmail.com';  // SMTP username
        $mail->Password = 'fvep quok uawr bfpa';  // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption
        $mail->Port = 587;  // TCP port to connect to

        //Recipients
        $mail->setFrom('info@vusiroofing.com', 'Vusi Roofing');
        $mail->addAddress('m10.jaber@gmail.com', 'Admin');     // Add a recipient
        $mail->addReplyTo('noreply@vusiroofing.com', 'No Reply');

        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Vusi Roofing Query';
        $mail->Body    = $message;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        exit;
    }

    // Prepare thank you email
    $mail->clearAddresses();
    $mail->addAddress($email);  // The user's email
    $mail->Subject = 'Thank you for contacting Vusi Roofing';
    $mail->Body    = "<html><body><p>Thank you for getting in touch!</p>
                     <p>We have received your message and would like to thank you for writing to us. If your inquiry is urgent, please call (613) 266-2014 to talk to one of our staff members.</p>
                     <p>Otherwise, we will reply by email as soon as possible.</p>
                     <p>Talk to you soon, Vusi Roofing</p></body></html>";

    if ($mail->send()) {
        header('Location: index.php?msg=success');
        exit;  // Ensure no further output is sent after header redirection
    } else {
		header('Location: index.php?msg=fail');
        //echo "Thank you email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        exit;
    }
}
?>
