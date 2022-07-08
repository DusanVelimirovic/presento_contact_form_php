<?php 

	$email_text = "Hey! Someone filled out the form at $_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI] \r\n\n";
	foreach( $_POST as $label => $value ) {
		if ( 'submit' !== $label ) {
			${$label} = $value;
			$email_text .= ucfirst( $label ) . ': ' . $value . "\r\n";
		}

	$to = 'dusan.velimirovicub@gmail.com';
	$subject = 'Form Sub from ' . $name;

	$headers = 'From: ' . $email . "\r\n" .
		'Reply-To: ' . $email . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

	mail( $to, $subject, $email_text, $headers);
} 

?>