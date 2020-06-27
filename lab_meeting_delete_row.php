
<?php



$row_id = $_POST['pass_row_id'];

$mysqli = new mysqli("127.0.0.1", "root", "sanshisuile87", "naya_lab");
if (!$mysqli) {
  die('save_cropped_ima mysql error ' . mysqli_error($mysqli));
}

$sql = "DELETE FROM lmr_mysql WHERE ID='$row_id'";

if (mysqli_query($mysqli, $sql)) {
  echo 'yes';
} else {
  // mysqli_query($this->db_link, $sql);
  die(' mysql error ' . mysqli_error($mysqli));
}
$mysqli->close();



die();
