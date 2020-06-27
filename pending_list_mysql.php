
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

$pass_id = $_POST['pass_user_id'];
$pass_email = $_POST['pass_email'];
$pass_identity = $_POST['pass_identity'];
$pass_membername = $_POST['pass_membername'];

// $conn = mysqli_connect("127.0.0.1", "root", "5t6y7u8i9o", "naya_lab");
$mysqli = new mysqli("127.0.0.1", "root", "****", "naya_lab");
if ($mysqli) {

  $sql= "UPDATE userinfo SET status=1 WHERE ID= $pass_id";
  if(mysqli_query($mysqli, $sql)) {
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
      //Server settings
      // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'mail.pku.edu.cn';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = '****@pku.edu.cn';                 // SMTP username
      $mail->Password = '****';                           // SMTP password
      $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 465;                                    // TCP port to connect to

      //Recipients
      $mail->setFrom('****@pku.edu.cn', 'lab website');
      $mail->addAddress($pass_email);     // Add a recipient

      //Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'Notification from lab website';
      $mail->Body    = '<font size="3">Dear <br><br> your registration has been confirmed.<br><br>' . '<a href="http://' . $_SERVER['HTTP_HOST'] . '/login_template.php">' . 'click to login</a>' .'<br><br> Best regards</font>';
      $mail->send();
    } catch (Exception $e) {
      echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }

    $insert_student = "INSERT INTO user_profile (`user_id`, `email_address`,`membername`,`identity`,`photo`,`self_desc`) VALUES ('$pass_id','$pass_email', '$pass_membername', '$pass_identity', '', '')";
    $insert_pi = "INSERT INTO user_profile_pi (`user_id`, `email_address`,`identity`,`photo`,`self_desc_en`,`self_desc_jp`,`self_desc_ch`) VALUES ('$pass_id', '$pass_email', '$pass_identity', '', '', '', '')";
    // if ($pass_identity=='student') {
    //   mysqli_query($conn, $insert_student);
    // }elseif ($pass_identity=='pi') {
    //   mysqli_query($conn, "INSERT INTO user_profile_pi (`user_id`, `email_address`,`identity`,`photo`,`self_desc_en`,`self_desc_jp`,`self_desc_ch`) VALUES ('$pass_id', '$pass_email', '$pass_identity', '', '', '', '')");
    // }
    if ($pass_identity=='student') {
      mysqli_query($mysqli, $insert_student);
      echo "yes";
    }elseif ($pass_identity=='pi') {
      mysqli_query($mysqli, $insert_pi);
      echo "yes";
    } else {
      echo "no";
    }
  }
  else {
    echo die('Cannot connect:' . mysqli_error($conn));
  }

}

die();
