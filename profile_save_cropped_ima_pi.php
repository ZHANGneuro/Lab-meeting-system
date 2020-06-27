

<?PHP


$pass_cropped_canvas = $_POST['pass_cropped_canvas'];
$pass_user_id = $_POST['pass_user_id'];

$pass_cropped_canvas = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $pass_cropped_canvas));
$saved_file_name = 'userid_' . $pass_user_id . "_" . date('Y_m_d_H_i_s') . '.png';
$export_path = $_SERVER['DOCUMENT_ROOT'] . '/user_profile_photo/' . $saved_file_name;
file_put_contents($export_path, $pass_cropped_canvas);


$mysqli = new mysqli("127.0.0.1", "root", "sanshisuile87", "naya_lab");
$sql = "UPDATE user_profile_pi SET photo='".$saved_file_name."'  WHERE user_id='".$pass_user_id."' ";
if ($mysqli->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
$mysqli->close();
