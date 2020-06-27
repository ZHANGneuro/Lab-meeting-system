
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

$email = $_POST['pass_email'];
$password = md5($_POST['pass_password']);
$membername = $_POST['pass_membername'];
$identity = $_POST['pass_identity'];

$mysqli = mysqli_connect("127.0.0.1", "root", "****", "naya_lab");
if ($mysqli) {
  $result = mysqli_query($mysqli, "SELECT * FROM userinfo WHERE email= '".$email."'");
  if(mysqli_num_rows($result) >= 1) {
    echo "exist";
  }
  else {
    $sql = "INSERT INTO userinfo (`email`,`password`,`identity`, `membername`,`perm`,`status`) VALUES ('$email', '$password', '$identity', '$membername', 'member', '0')";
    if (mysqli_query($mysqli, $sql)) {
      echo 'yes';
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
        $mail->addAddress('bo.zhang@pku.edu.cn');     // Add a recipient

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'someone registered, check it';
        $mail->Body    = 'someone registered, check it';

        $mail->send();
        // echo 'Message has been sent';
      } catch (Exception $e) {
        // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
      }

    }
  }
}







die();
