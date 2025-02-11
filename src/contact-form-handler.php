<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Перевірка Honeypot
  if (!empty($_POST['honeypot'])) {
      echo json_encode(["status" => "error", "message" => "Spam detected! Your message was not sent."]);
      exit;
  }

  // Ваш код обробки форми (як ви писали)
  $name = htmlspecialchars($_POST['name']);
  $phone = htmlspecialchars($_POST['phone']);
  $email = htmlspecialchars($_POST['email']);
  $business = htmlspecialchars($_POST['business']);
  $message = htmlspecialchars($_POST['message']);
  
  $to = "bk@solvensy.com";
  $subject = "New Contact Form Submission";
  $headers = "From: no-reply@solvensy.com\r\n";
  $headers .= "Reply-To: $email\r\n";
  $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
  
  $body = "Name: $name\n";
  $body .= "Phone: $phone\n";
  $body .= "Email: $email\n";
  $body .= "Business: $business\n";
  $body .= "Message:\n$message\n";
  
  if (mail($to, $subject, $body, $headers)) {
      echo json_encode(["status" => "success", "message" => "Thank you! Your message has been sent."]);
  } else {
      echo json_encode(["status" => "error", "message" => "Error! Message not sent."]);
  }
} else {
  echo json_encode(["status" => "error", "message" => "Invalid request!"]);
}
?>
