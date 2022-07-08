<?php
$message = '';
echo $message;
foreach( $_POST as $name => $value ) {
    if ( 'submit' != $name ) {
        if ( is_array( $value ) ) {
            $value = implode( ', ', $value );
        }
        //smestamo sve podatke iz kontaktne forme
         $message .= ucfirst( $name ) ." is $value.\n\n"; 
    } 
 }

 $to = "dusan.velimirovic@trlic.com";
 $subject = "Reason for Contact: " . $_POST['reason'];


 if ( mail( $to, $subject, $message, 'From: dusan.velimirovic@yahoo.com') ) {
     echo "<h3>Your message has been sent.</h3>";
 }