<?php

function validate_mail_data($mail_data)
{
  $errors = [];
  //validate name
  if (!has_presence($mail_data['name'])) {
    $errors[] = "Molimo Vas da unesete Vaše ime";
  } elseif (!has_length($mail_data['name'], ['min' => 2, 'max' => 20])) {
    $errors[] = "Vaše ime mora imati više od 2 a manje od 50 karaktera";
  }

  //validate email
  if (!has_presence($mail_data['email'])) {
    $errors[] = "Molimo Vas da unesete Vaše email";
  } elseif (!has_valid_email_format($mail_data['email'])) {
    $errors[] = "Vaš email mora imati validan format";
  }

  //validate subject
  if (!has_presence($mail_data['subject'])) {
    $errors[] = "Molimo Vas da unesete naslov Vaše poruke";
  } elseif (!has_length($mail_data['subject'], ['min' => 5, 'max' => 100])) {
    $errors[] = "Naslov Vaše poruke mora imati više od 5 a manje od 100 karaktera";
  }

  //validate message
  if (!has_presence($mail_data['message'])) {
    $errors[] = "Molimo Vas da unesete tekst Vaše poruke";
  } elseif (!has_length($mail_data['message'], ['min' => 5, 'max' => 5000])) {
    $errors[] = "Tekst Vaše poruke mora imati više od 5 a manje od 5000 karaktera";
  }

  if (!empty($errors)) {
    return $errors;
  } else {
    return true;
  }
}

function display_errors($errors = array())
{
  $output = '';
  if (!empty($errors)) {
    $output .= "<div class=\"errors\">";
    $output .= "Molimo Vas da ispravite sledece greske:";
    $output .= "<ul>";
    foreach ($errors as $error) {
      $output .= "<li>" . $error . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}

function get_and_clear_session_message()
{
  if (isset($_SESSION['message']) && $_SESSION['message'] != '') {
    $msg = $_SESSION['message'];
    unset($_SESSION['message']);
    return $msg;
  }
}

function display_session_message()
{
  $msg = get_and_clear_session_message();
  if (!empty($msg)) {
    return '<div>' . $msg . '</div>';
  }
}

function process_form($mail_data)
{
  $email_text = "Dobar dan! Dobili ste novu poruku preko Vaše kontaktne forme $_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI] \r\n\n";
  foreach ($_POST as $label => $value) {
    if ('submit' !== $label) {
      ${$label} = $value;
      $email_text .= ucfirst($label) . ': ' . $value . "\r\n";
    }
  }

  $to = 'dusan.velimirovicub@gmail.com';
  $subject = 'Poruka sa sledećeg email-a ' . $mail_data['name'];

  $headers = 'From: ' . $mail_data['email'] . "\r\n" .
    'Reply-To: ' . $mail_data['email'] . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  mail($to, $subject, $email_text, $headers);
}
