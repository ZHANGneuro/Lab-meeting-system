
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

$email = $_POST['pass_email'];

# generate temporal file

$temp_directory_name= __DIR__ . "/temp/temp_" .$email.  ".html";
$temp_weburl_name= $_SERVER['HTTP_HOST'] . "/temp/temp_" .$email.  ".html";

$myfile = fopen($temp_directory_name, "w");
$txt = "
<html>
<head>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>
<title>*** lab</title>
<script
src='http://code.jquery.com/jquery-3.3.1.js'
integrity='sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60='
crossorigin='anonymous'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
</head>

<script>
var pwd_status=0;
var file_path = '".$temp_directory_name ."'
</script>

<style>
#mydiv {
  width: 200px;
  margin: 5% auto auto auto;
  background-color: #FAD74F;
  width:300px;
  height: auto;
  border: 0px solid #ccc;
  display: table;
}
.margin_left {
  margin-left: 5%;
}
#feedback {
  width: 300px;
  /* height: 30px; */
  margin: 2% auto auto auto;
}
#background {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 340px;
  height:340px;
  margin: 0% auto auto auto;
  display: -webkit-box;  /* OLD - iOS 6-, Safari 3.1-6, BB7 */
  display: -ms-flexbox;  /* TWEENER - IE 10 */
  display: -webkit-flex; /* NEW - Safari 6.1+. iOS 7.1+, BB10 */
  display: flex;         /* NEW, Spec - Firefox, Chrome, Opera */
  justify-content: center;
  /* text-align: center; */
}
#email {
  width: 250px;
  margin: 15% auto auto auto;
}
#psw {
  width: 250px;
  margin: 0% auto auto auto;
}
#confirm_psw {
  width: 250px;
  margin: 5% auto auto auto;
}
#btn_updating {
  width: 200px;
  margin: 10% auto auto auto;
}
#btn_login {
  width: 200px;
  margin: auto auto auto auto;
}
</style>


<div id='mydiv'>
<p></p>
<p class='margin_left'>
<ol>
   <li>type your new password.</li>
   <li>once you successfully change the password, this temporal webpage will be deleted.</li>
</ol>
</div>

<div class='form-group text-center' id='feedback' style='color:red'></div>

<div id='background' class='shadow-lg p-3 mb-5 bg-white rounded'>
<form method='post' class='login-form'>

<div class='form-group text-center'>
<input type='text' class='form-control' id='email' value='" . $email . "' disabled>
</div>
<div class=‘form-group text-center’>
<input type='password' class='form-control' id='psw' placeholder='new password' value=''>
</div>
<div class=‘form-group text-center’>
<input type='password' class='form-control' id='confirm_psw' placeholder='confirm new password' value=''>
</div>
<div class='form-group text-center'>
<button type='submit' id='btn_updating' class='btn btn-outline-secondary'>change</button>
</div>
<div class='form-group text-center'>
<button type='submit' id='btn_login' class='btn btn-outline-secondary' disabled>Login</button>
</div>

</form>
</div>

<script type='text/javascript'>

$(document).ready(function($) {
  $('#btn_updating').on( 'click', function (e) {
    e.preventDefault();
    var email = document.getElementById('email').value;
    var psw = document.getElementById('psw').value;
    var confirm_psw = document.getElementById('confirm_psw').value;
    if (!psw | !confirm_psw) {
      document.getElementById('feedback').innerHTML = 'password cannot be empty';
    } else {
      if (psw !== confirm_psw) {
        document.getElementById('feedback').innerHTML = 'passwords do not match';
      }
      if (psw == confirm_psw) {
        pwd_status = 1;
      }
    }

    if (pwd_status==1) {

      $.ajax({
        type: 'POST',
        url: '/reset_pwd_update_mysql.php',
        data: {
          pass_email : email,
          pass_password : psw,
          pass_filepath : file_path
        },
        success: function(data) {
          var returned = $.trim(data);
          if (returned === 'yes') {
            document.getElementById('feedback').innerHTML = 'your password has been updated, try to login';
            var temp_feedback = document.getElementById('feedback');
            temp_feedback.style.color = '#086375';
            document.getElementById('btn_updating').disabled = true;
            document.getElementById('btn_login').disabled = false;
          }
          if (returned === 'no') {
            document.getElementById('feedback').innerHTML = 'check your email address, or contact admin';
          }
        }
      });
    }
  });

  $('#btn_login').on( 'click', function (e) {
    e.preventDefault();
    window.location = '/login_template.php';
  });

});

</script>
</html>
";
fwrite($myfile, $txt);
fclose($myfile);



# send email
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
  //Server settings
  // $mail->SMTPDebug = 1;                                 // Enable verbose debug output
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'mail.pku.edu.cn';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'gxlxy_yujilab';                 // SMTP username
  $mail->Password = '5t6y7u8i9o';                           // SMTP password
  $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 465;                                    // TCP port to connect to

  //Recipients
  $mail->setFrom("gxlxy_yujilab@pku.edu.cn", 'Yuji Lab Mailer');
  $mail->addAddress($email);     // Add a recipient

  //Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'reset password of lab website';
  $mail->Body    =  stripslashes("<a href='http://".$temp_weburl_name."'>" . "click to reset password".  "</a>");


  if ($mail->send()) {
    echo 'yes';
  }else {
    echo 'no';
  }

} catch (Exception $e) {
  echo 'Mailer Error: ', $mail->ErrorInfo;
}




die();
