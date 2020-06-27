
<?php



$email_addre = $_POST['pass_email_addre'];
$password = md5($_POST['pass_password']);

$mysqli = mysqli_connect("127.0.0.1", "root", "sanshisuile87", "naya_lab");
if ($mysqli) {
  $result = mysqli_query($mysqli, "SELECT * FROM userinfo WHERE email= '".$email_addre."' AND password= '".$password."'");
  if(mysqli_num_rows($result) >= 1) {

    $getstatus = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT status FROM userinfo WHERE email= '".$email_addre."'"));
    $status = $getstatus['status'];

    $getPemission = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT perm FROM userinfo WHERE email= '".$email_addre."'"));
    $perm = $getPemission['perm'];

    $getID = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT ID FROM userinfo WHERE email= '".$email_addre."'"));
    $ID = $getID['ID'];

    $getIdentity = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT identity FROM userinfo WHERE email= '".$email_addre."'"));
    $identity = $getIdentity['identity'];

    $getName = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT membername FROM userinfo WHERE email= '".$email_addre."'"));
    $member_name = $getName['membername'];

    if ($status==0) {
      echo json_encode(array($perm, "pending", $ID, $identity, $member_name));
    }
    if ($status==1) {
      echo json_encode(array($perm, "passed", $ID, $identity, $member_name));
    }
  }
  else {
    echo json_encode(array($perm, "no", $ID, $identity, $member_name));
  }

}







die();
