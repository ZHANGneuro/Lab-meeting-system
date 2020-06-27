
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';


$email_list_array = $_REQUEST['pass_email_list'];
$email_title = $_POST['pass_email_title'];
$email_content = $_POST['pass_email_content'];
$file_title_array = $_REQUEST['pass_title_array'];
$speaker = $_POST['pass_speaker'];



$file_path = $_SERVER['DOCUMENT_ROOT']. '/uploaded_files/';
$prefixed_array = preg_filter('/^/', $file_path, $file_title_array);



$new_content = stripslashes($email_content) . "--------------<br>attached files were listed below (click to download):<br>";

for ($i=0; $i < count($prefixed_array); $i++) {
  $new_content .= "<br><a href='" . $_SERVER['DOCUMENT_ROOT'] ."/uploaded_files/" . $file_title_array[$i] . "'>" . rawurldecode($file_title_array[$i]) . "</a><br>";
}

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
  //Server settings
  // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
  $mail->CharSet = 'UTF-8';
  $mail->Encoding = 'base64';
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'mail.pku.edu.cn';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = '****';                 // SMTP username
  $mail->Password = '****';                           // SMTP password
  $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 465;                                    // TCP port to connect to

  //Recipients
  $mail->setFrom('***@pku.edu.cn', 'Lab Mailer');

  for ($i=0; $i < count($email_list_array); $i++) {
    $mail->addAddress($email_list_array[$i]);     // Add a recipient
  }

  //Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = $email_title;
  $mail->Body    = $new_content;


  if ($mail->send()) {
    echo 'Message has been sent';
  }else {
    echo 'Not able to send';
  }

} catch (Exception $e) {
  echo 'Not able to send, open "its.pku.edu.cn" and login username: ****, pass:****';
}








die();
