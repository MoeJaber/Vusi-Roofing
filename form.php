<?php
		if(isset($_POST['contact_submit']) && $_POST['contact_submit'] != ''){

			// Contact form message functionality
			if(isset($_POST['contact_submit']) && !empty($_POST['contact_submit'])){ 
				// PREPARE THE BODY OF THE MESSAGE
				$message = '<html><body>';
				$message .= 'Vusi Roofing - Hi admin, you got a new query from your website.';
				$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
				$message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['first_name']) .' '. strip_tags($_POST['last_name']) ."</td></tr>";
				$message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
				$message .= "<tr><td><strong>Phone Number:</strong> </td><td>" . strip_tags($_POST['phone_number']) . "</td></tr>";
				$message .= "<tr><td><strong>Address:</strong> </td><td>" . $_POST['address'] . "</td></tr>";
				$message .= "<tr><td><strong>Service required:</strong> </td><td>" . $_POST['sellist1'] . "</td></tr>";
				$message .= "</table>";
				$message .= "</body></html>";

				//  MAKE SURE THE "FROM" EMAIL ADDRESS DOESN'T HAVE ANY NASTY STUFF IN IT
				$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i";
				if (preg_match($pattern, trim(strip_tags($_POST['email'])))) {
					$cleanedFrom = trim(strip_tags($_POST['email']));
				} else {
					return "The email address you entered was invalid. Please try again!";
				}

				// Mailing system
    				//   CHANGE THE BELOW VARIABLES TO YOUR NEEDS

    			$to = 'Info@vusiroofing.com';

    			$subject = 'Vusi Roofing';

    			$headers = "From: contactus@coderzguild.website \r\n";
    			$headers .= "Reply-To: noreply@coderzguild.website \r\n";
    			$headers .= "MIME-Version: 1.0\r\n";
    			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                $thanksemail = $_POST['email'];
                $message2 = 'Hi, '.$_POST['first_name'].', Thank you for reaching us. One of our executive will contact you soon.';

                if (mail($to, $subject, $message, $headers) && mail($thanksemail, $subject, $message2, $headers)) {
                  header('Location: index.php?msg=success');
                } else {
                  header('Location: index.php?msg=fail');
                }
			}

		}



?>
