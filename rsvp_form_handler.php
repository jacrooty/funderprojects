<?php
/**
 * File Name: contact_form_handler.php
 *
 * Send message function to process contact form submission
 *
 */
if(isset($_POST['email'])):

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $address = $_POST['target'];

    if(get_magic_quotes_gpc()) {
        $message = stripslashes($message);
    }
	
	$message = $_SERVER['HTTP_USER_AGENT'];

    $e_subject = 'RSVP from ' . $name . '.';

    if(!empty($subject))
    {
        $e_subject = $subject . '.';
    }

    $e_body = 	"You have RSVP from: "
        .$name
        . "\n"
        ."Their email address is: "
		.$email
        ."\r\n\n";

    $e_content = "\" $message \"\r\n\n";

    $e_reply = 	"Browser Details: ";

    $msg = $e_body . $e_reply . $e_content ;

    if(mail($address, $e_subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n","-f $address"))
    {
		header("Location: http://innovationpress.org/thanks.html");
		exit;
    }
    else
    {
		header("Location: http://innovationpress.org/oops.html");
		exit;
    }
else:
    echo "Invalid Request !";
endif;

die;




?>