
<html>

<title>*** lab</title>
<script src="/js_library/jquery-3.3.1.js"></script>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<style>
#mydiv {
  position:relative;
  margin-left: auto;
  margin-right: auto;
  top: 200px;
  width:40em;
  height:5em;
  border: 1px solid #ccc;
  background-color: #B8E0D2;
  display: table;
}
#the_table {
  position:relative;
  margin-left: auto;
  margin-right: auto;
  top: 200px;
  width:40em;
  height:5em;
  background-color: pink;
  display: table;
}
#inner_text{
  display: table-cell;
  border: 0px solid #ccc;
  width:40em;
  text-align: center;
  vertical-align : middle;
  font-size: 1.3em;
}
</style>

<?php
include('header.php');
 ?>
<?php
$mysqli = mysqli_connect("127.0.0.1", "root", "sanshisuile87", "naya_lab");
if ($mysqli) {
  $result = mysqli_query($mysqli, "SELECT * FROM userinfo WHERE status= 0");
  $count = mysqli_num_rows($result);
  if ($count == 0) {
    echo '<div id="mydiv">';
    echo '<p id="inner_text">';
    echo 'No pending registration';
    echo '</p>';
    echo '</div>';
  } else {
    echo '<table id="the_table">';
    while ( $row = mysqli_fetch_assoc($result) ) {
      $row_id = $row ['ID'];
      $email = $row ['email'];
      $identity = $row ['identity'];
      $membername = $row ['membername'];
      echo '<tr style="border: 1px solid rgb(190, 190, 190);">';
      echo '<td  align="middle" style="font-family: sans-serif;background-color:#d7d9f2;color:black;">'.$row_id.'</td>';
      echo '<td  align="middle" style="font-family: sans-serif;background-color:#d7d9f2;color:black;">'.$email.'</td>';
      echo '<td  align="middle" style="font-family: sans-serif;background-color:#d7d9f2;color:black;">'.$identity.'</td>';
      echo '<td  align="middle" style="font-family: sans-serif;background-color:#d7d9f2;color:black;">'.$membername.'</td>';
      echo '<td  align="middle" style="font-family: sans-serif;background-color:#d7d9f2;">
      <div style="display: table-cell;vertical-align : middle;" class="form-group text-center">
      <button type="button" id="button_'.$row_id.'_'.$email.'_'.$identity.'_'.$membername.'" class="btn btn-light">allow</button>
      </div>
      </td>';
      echo '</tr>';
    }
    echo'</table>';
  }
}
?>

<script type="text/javascript">
$(document).ready(function($) {
  $('#the_table').on( 'click', function (e) {
    e.preventDefault();

    var but_id =$(document.activeElement).attr('id');
    var row_ith = but_id.split("_");
    $.ajax({
      type: "POST",
      url: "pending_list_mysql.php",
      data: {
        pass_user_id : row_ith[1],
        pass_email: row_ith[2],
        pass_identity: row_ith[3],
        pass_membername: row_ith[4]
      },
      success: function(data) {
        var returned = $.trim(data);
        if (returned=="yes") {
          console.log("yes");
          var button_disable = document.getElementById(but_id);
          button_disable.disabled = true;
          var button_innertext = document.getElementById(but_id).innerText;
          button_innertext= "updated";
        } else if (returned=="no") {
          console.log("no");
        }else {
           console.log(data);
        }
      }
    });
  });
});
</script>




</html>
