
<?php

$current_date = $_POST['pass_date'];
$member_name = $_POST['pass_member_name'];



$mysqli = new mysqli("127.0.0.1", "root", "sanshisuile87", "naya_lab");
if (!$mysqli) {
  die('save_cropped_ima mysql error ' . mysqli_error($mysqli));
}

$sql = "INSERT INTO lmr_mysql (`Date`, `Speaker`, `Article`,`Author`,`Journal`) VALUES ('$current_date', '$member_name', ' ', ' ', ' ')";

if (mysqli_query($mysqli, $sql)) {
  echo 'yes';
} else {
  // mysqli_query($this->db_link, $sql);
  die(' mysql error ' . mysqli_error($mysqli));
}
$mysqli->close();




die();
