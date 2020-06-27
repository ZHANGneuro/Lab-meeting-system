
<?PHP

$pass_profile_text = $_POST['pass_text'];
$pass_type = $_POST['pass_type'];
$pass_user_id = $_POST['pass_user_id'];

$mysqli = new mysqli("127.0.0.1", "root", "sanshisuile87", "naya_lab");
if (!$mysqli) {
  die('save_cropped_ima mysql error ' . mysqli_error($link));
}

if ($pass_type == "Chinese") {
  $sql = "UPDATE user_profile_pi SET self_desc_ch='".$pass_profile_text."'  WHERE user_id='".$pass_user_id."' ";
} elseif ($pass_type == "Japanese") {
  $sql = "UPDATE user_profile_pi SET self_desc_jp='".$pass_profile_text."'  WHERE user_id='".$pass_user_id."' ";
} elseif ($pass_type == "English") {
  $sql = "UPDATE user_profile_pi SET self_desc_en='".$pass_profile_text."'  WHERE user_id='".$pass_user_id."' ";
}

if ($mysqli->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
$mysqli->close();
