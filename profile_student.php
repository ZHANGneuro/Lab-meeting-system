
<html>

<title>*** Lab</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<head>
  <script src="/js_library/jquery-3.3.1.js"></script>
  <script src="/tinymce_js/tinymce.min.js"></script>
  <link rel="stylesheet" href="/js_library/bootstrap.min.css">
  <script src="/tinymce_js/tinymce.min.js"></script>
  <script src="/cropper_js/cropper.js"></script>
  <link rel="stylesheet" href="/cropper_js/cropper.css">
</head>

<style>
#main_profile_content {
  position:absolute;
  top: 25%;
  left: 30%;
  width:100%;
}

img {
  max-width: 100%; /* This rule is very important, please do not ignore this! */
}
</style>

<script>
var user_id = sessionStorage.getItem('user_id');
var js_user_id_array=[];
var js_user_name_array=[];
var js_user_email_array=[];
var js_user_photo_array=[];
var js_user_text_array_recovered=[];
tinymce.init({
  selector: '#editor_' + user_id,
  statusbar: false,
  menubar: false,
  theme: 'modern',
  fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
  plugins: "advlist lists image textcolor code paste",
  height: 150,
  toolbar: 'fontsizeselect formatselect outdent indent bold italic strikethrough | forecolor backcolor | alignleft aligncenter alignright | numlist bullist'
});
</script>

<?php
$mysqli = mysqli_connect("127.0.0.1", "root", "sanshisuile87", "naya_lab");
if ($mysqli) {
  # fill js_user_id_array  js_user_photo_array  js_user_text_array_recovered
  $profile_mysql = mysqli_query($mysqli, "SELECT * FROM user_profile WHERE identity= 'student'");
  $num_sub = mysqli_num_rows($profile_mysql);
  while ( $row = mysqli_fetch_assoc($profile_mysql) ) {
    $user_id = $row ['user_id'];
    $user_name = $row ['membername'];
    $user_email = $row ['email_address'];
    $photo = $row ['photo'];
    $pre_self_desc = $row ['self_desc'];
    $self_desc = str_replace("REPLACE", "'", $pre_self_desc);
    echo '<script type="text/javascript">
    js_user_id_array.push("'. $user_id .'");
    js_user_name_array.push("'. $user_name .'");
    js_user_email_array.push("'. $user_email .'");
    js_user_photo_array.push("'. $photo .'");
    js_user_text_array_recovered.push("'. $self_desc .'");
    </script>';
  }
}
?>

<?php
include('header.php');
?>

<body>
  <table id="main_profile_content">
  </table>
  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Crop your photo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div>
            <img id="popup_ima_frame">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="btn btn-default" data-dismiss="modal" class="btn btn-outline-secondary">Cancel</button>
          <button type="submit" id="button_on_popupframe" class="btn btn-outline-secondary">Crop</button>
        </div>
      </div>
    </div>
  </div>
  <script src="/js_library/popper.min.js"></script>
  <script src="/js_library/bootstrap.min.js"></script>
</body>


<script type="text/javascript">
var main_profile_content_div  = document.getElementById('main_profile_content');
main_profile_content_div.setAttribute("style", "background: white; width: 60%; height: 250px");
for (var i = 0; i < <?php echo $num_sub ?>; i++) {
  var newdiv = document.createElement("tr");
  var sub_div1 = document.createElement("td");
  var sub_div2 = document.createElement("td");
  var sub_div3 = document.createElement("td");
  var col_gap1 = document.createElement("td");
  var col_gap2 = document.createElement("td");
  var col_gap3 = document.createElement("td");

  sub_div1.setAttribute("style", "background-color:white; height: 250px; width: 25%; text-align:center; vertical-align:middle");
  sub_div2.setAttribute("style", "background-color:white; height: 250px; width: 45%; text-align:left; vertical-align:middle");
  sub_div3.setAttribute("style", "background-color:white; height: 250px; width: 20%; text-align:right; vertical-align:middle");
  col_gap1.setAttribute("style", "background-color:white; height: 250px; width: 4%");
  col_gap2.setAttribute("style", "background-color:white; height: 250px; width: 3%");
  col_gap3.setAttribute("style", "background-color:white; height: 250px; width: 3%");
  if (js_user_photo_array[i]) {
    sub_div1.innerHTML = '<img id="avatar_'+ js_user_id_array[i] +'" style="max-height:100%; max-width:100%" src="' + '/user_profile_photo/' + js_user_photo_array[i] + '" />';
  } else {
    sub_div1.innerHTML = '<img id="avatar_'+ js_user_id_array[i] +'" style="max-height:100%; max-width:100%" src="' + '/user_profile_photo/Profile-empty.png' + '" />';
  }
  if (js_user_text_array_recovered[i]) {

    sub_div2.innerHTML = ' <table cellpadding=0 cellspacing=0 class="self_describe_table">  <tr style="background-color:white; font-size: 1.2em;"><td>'+ js_user_name_array[i] +'</td></tr>  <tr style="background-color:white;font-size: 1.2em;"><td>'+ js_user_email_array[i] +'</td></tr>    <tr style="background-color:white; height: 20px;"><td></td></tr>   <tr><td><div  id="text_'+ js_user_id_array[i] +'" style="display: block;">' + js_user_text_array_recovered[i] + '</div>' +
    '<form method="post"> <div id="show_editor_'+
     js_user_id_array[i] +'" style="display:none;"> <textarea id="editor_'+ js_user_id_array[i] +'">'+ js_user_text_array_recovered[i] +'</textarea></div></form></td></tr></table>';

  } else {

    sub_div2.innerHTML = '<table cellpadding=0 cellspacing=0 class="self_describe_table"><tr style="background-color:white; font-size: 1.2em;"><td>'+ js_user_name_array[i] +'</td></tr>  <tr style="background-color:white; font-size: 1.2em;"><td>'+ js_user_email_array[i] +'</td></tr>  <tr style="background-color:white; height: 20px;"><td></td></tr>   <tr><td><div  id="text_'+ js_user_id_array[i] +'" style="display: block;">' +'this guy did not edit anything' + '</div>' + '<form method="post"> <div id="show_editor_'+ js_user_id_array[i] +'" style="display:none;"> <textarea id="editor_'+ js_user_id_array[i] +'" name="editor_'+ js_user_id_array[i] +'"></textarea></div></form></td></tr></table>';

  }
  if (sessionStorage.getItem('login_status')=='in' && (user_id == js_user_id_array[i])) {
    sub_div3.innerHTML = '<input id="button_div" type="file" hidden/> <button type="submit" id="button_upload_photo" class="btn btn-outline-secondary" style="width: 100%; height:20%; padding: 0px; margin: 0px 0px;">upload photo</button><button type="submit" id="button_edit" class="btn btn-outline-secondary" style="width: 100%; height:20%; padding: 0px; margin: 10px 0px;">edit text</button>';
  }
  newdiv.appendChild(sub_div1);
  newdiv.appendChild(col_gap1);
  newdiv.appendChild(sub_div2);
  newdiv.appendChild(col_gap2);
  newdiv.appendChild(sub_div3);
  newdiv.appendChild(col_gap3);
  main_profile_content_div.appendChild(newdiv);

  var row_gap = document.createElement("tr");
  row_gap.setAttribute("style", "background: white; width: 70%; height: 88px");
  main_profile_content_div.appendChild(row_gap);
}
</script>





<script>
if (sessionStorage.getItem('user_identity')=='student') {
  function openDialog() {
    document.getElementById('button_div').click();
  }
  document.getElementById('button_upload_photo').addEventListener('click', openDialog);
  window.addEventListener('DOMContentLoaded', function () {
    var avatar = document.getElementById('avatar_' + user_id);
    var image = document.getElementById('popup_ima_frame');
    var input = document.getElementById('button_div');
    var $modal = $('#modal');
    var cropper;
    button_div.addEventListener('change', function (e) {
      var files = e.target.files;
      var done = function (url) {
        input.value = '';
        image.src = url;
        $modal.modal('show');
      };
      var reader;
      var file;
      var url;
      if (files && files.length > 0) {
        file = files[0];
        // if (URL) {
        done(URL.createObjectURL(file));
        // } else if (FileReader) {
        //   reader = new FileReader();
        //   reader.onload = function (e) {
        //     done(reader.result);
        //   };
        //   reader.readAsDataURL(file);
        // }
      }
    });
    $modal.on('shown.bs.modal', function () {
      cropper = new Cropper(image, {
        aspectRatio: 2.3/3,
      });
    }).on('hidden.bs.modal', function () {
      cropper.destroy();
      cropper = null;
    });
    document.getElementById('button_on_popupframe').addEventListener('click', function () {
      var canvas;
      $modal.modal('hide');
      if (cropper) {
        canvas = cropper.getCroppedCanvas({
          imageSmoothingEnabled: true,
          imageSmoothingQuality: 'high',
        });
        avatar.src = canvas.toDataURL();
        $.ajax({
          type: "POST",
          url: "profile_save_cropped_ima_student.php",
          data: {
            pass_cropped_canvas : canvas.toDataURL(),
            pass_user_id :user_id
          },
          success: function(data) {
            // console.log(data);
          }
        });
      }
    });

    document.getElementById('button_edit').addEventListener('click', function () {
      if (document.getElementById("button_edit").innerHTML === "save") {
        document.getElementById("button_edit").innerHTML = "edit text";
        var temp_show_editor = document.getElementById("show_editor_"+ user_id);
        temp_show_editor.style.display = "none";
        var returned_text = tinyMCE.activeEditor.getContent({format: 'raw'});
        document.getElementById("text_"+ user_id).innerHTML = returned_text;

        returned_text = returned_text.replace(/"/g, 'REPLACE');
        var temp_text = document.getElementById("text_"+ user_id);
        temp_text.style.display = "block";
        $.ajax({
          type: "POST",
          url: "profile_save_content_student.php",
          data: {
            pass_text :returned_text,
            pass_user_id :user_id
          },
          success: function(data) {
            // console.log(data);
          }
        });
      } else if (document.getElementById("button_edit").innerHTML === "edit text") {
        document.getElementById("button_edit").innerHTML = "save";
        var temp_text = document.getElementById("text_"+ user_id);
        temp_text.style.display = "none";
        var temp_show_editor = document.getElementById("show_editor_"+ user_id);
        temp_show_editor.style.display = "block";
      }
    });
  });

}

</script>






</html>
