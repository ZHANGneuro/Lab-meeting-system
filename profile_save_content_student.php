
<?PHP

$pass_profile_text = $_POST['pass_text'];
$pass_user_id = $_POST['pass_user_id'];


$mysqli = new mysqli("127.0.0.1", "root", "sanshisuile87", "naya_lab");

$sql = "UPDATE user_profile SET self_desc='".$pass_profile_text."'  WHERE user_id='". $pass_user_id. "' ";
if ($mysqli->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
$mysqli->close();
