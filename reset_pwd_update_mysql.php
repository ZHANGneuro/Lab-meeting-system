
<?php

$pass_email = $_POST['pass_email'];
$pass_password = md5($_POST['pass_password']);
$pass_filepath = $_POST['pass_filepath'];

$conn = mysqli_connect("127.0.0.1", "root", "sanshisuile87", "naya_lab");
if ($conn) {
  $sql= "UPDATE userinfo SET password='$pass_password' WHERE email='$pass_email'";
  if(mysqli_query($conn, $sql)) {
    echo "yes";
    unlink($pass_filepath);
  }
  else {
    echo "no";
  }
}



die();
