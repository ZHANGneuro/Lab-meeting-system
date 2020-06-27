<?PHP


$del_paper_title = $_POST['pass_paper_title'];
$path = $_SERVER['DOCUMENT_ROOT']. '/uploaded_files/' . $del_paper_title;

if (unlink($path)) {
echo ("deleted");
} else {
echo ("error deleting");
}


die();
