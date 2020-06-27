<?PHP


$pre_uploaded_file = $_FILES['file'];
$file_name=$pre_uploaded_file['name'];
$file_name=str_replace("?","", $file_name);

$allowed_character_array=str_split(" ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-._~:/?#[]@!$&'()*+,;=");
$url_cha_array = str_split($file_name);


$num_indicator=array();
for ($i=0; $i < count($url_cha_array); $i++) {
  if (in_array($url_cha_array[$i], $allowed_character_array)) {
    array_push($num_indicator,"1");
  }
}


if (count($num_indicator)==count($url_cha_array)) {
  $path = $_SERVER['DOCUMENT_ROOT']. '/uploaded_files/' . $file_name;
  if(move_uploaded_file($pre_uploaded_file['tmp_name'], $path)) {
    echo json_encode(array("uploaded", rawurlencode($file_name)));
  } else {
    // echo json_encode(array("filename contains unallowed character ", $file_name));
    echo json_encode(array($path));
  }
}else {
  echo json_encode(array("filename contains unallowed character ", $file_name)); ;
}




die();
