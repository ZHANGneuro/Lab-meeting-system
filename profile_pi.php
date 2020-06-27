<html>

<head>
  <title>*** Lab</title>

  <script src="/js_library/jquery-3.3.1.js"></script>
  <script src="/tinymce_js/tinymce.min.js"></script>
  <script src="/cropper_js/bootstrap.bundle.min.js"></script>
  <script src="/cropper_js/cropper.js"></script>
  <link rel="stylesheet" href="/cropper_js/bootstrap.min.css">
  <link rel="stylesheet" href="/cropper_js/cropper.css">
</head>

<style type="text/css">
#main_profile_table {
  position:absolute;
  top: 30%;
  left: 25%;
  width:75%;
}
.col_1st {
  width: 15%;
  background-color: white;
}
.col_2nd {
  width: 2%;
  background-color: white;
}
.col_3rd {
  width: 45%;
  background-color: white;
  vertical-align: top;
}
.col_4th {
  width: 2%;
  background-color: white;
}
.col_5th {
  width: 25%;
  background-color: white;
  vertical-align: top;
}
.col_6th {
  width: 2%;
  background-color: white;
}
.cell_gap {
  width: 5%;
}
img {
  max-width: 100%; /* This rule is very important, please do not ignore this! */
}
</style>


<?php
include('header.php');
?>

<script>
var user_id = sessionStorage.getItem('user_id');
tinymce.init({
  selector: '#editor_english',
  statusbar: false,
  menubar: false,
  theme: 'modern',
  plugins: "advlist lists image textcolor code paste",
  height: 280,
  toolbar: 'formatselect outdent indent bold italic strikethrough | forecolor backcolor | alignleft aligncenter alignright | numlist bullist'
});
tinymce.init({
  selector: '#editor_japanese',
  statusbar: false,
  menubar: false,
  theme: 'modern',
  plugins: "advlist lists image textcolor code paste",
  height: 280,
  toolbar: 'formatselect outdent indent bold italic strikethrough | forecolor backcolor | alignleft aligncenter alignright | numlist bullist'
});
tinymce.init({
  selector: '#editor_chinese',
  statusbar: false,
  menubar: false,
  theme: 'modern',
  plugins: "advlist lists image textcolor code paste",
  height: 280,
  toolbar: 'formatselect outdent indent bold italic strikethrough | forecolor backcolor | alignleft aligncenter alignright | numlist bullist'
});
</script>

<?php
$mysqli = mysqli_connect("127.0.0.1", "root", "sanshisuile87", "naya_lab");
if ($mysqli) {
  # fill $profile_photo  $profile_text_jap  $profile_text_en $profile_text_ch
  $profile_mysql = mysqli_query($mysqli, "SELECT * FROM user_profile_pi WHERE identity= 'pi' ");
  $num_sub = mysqli_num_rows($profile_mysql);
  while ( $row = mysqli_fetch_assoc($profile_mysql) ) {
    $user_id = $row ['user_id'];
    $profile_photo = $row ['photo'];
    $pre_profile_text_en = $row ['self_desc_en'];
    $pre_profile_text_jap = $row ['self_desc_jp'];
    $pre_profile_text_ch = $row ['self_desc_ch'];
    $profile_text_en = str_replace("REPLACE", "'", $pre_profile_text_en);
    $profile_text_jap = str_replace("REPLACE", "'", $pre_profile_text_jap);
    $profile_text_ch = str_replace("REPLACE", "'", $pre_profile_text_ch);
  }
}
?>

<body>

  <table id="main_profile_table">
    <tr>
      <td class="col_1st">
        <div id="div_photo" style="width:220px; position: relative; margin: 0 auto;">
          <?php
          if ($profile_photo) {
            ?>
            <img id="avatar" style="max-height:100%; max-width:100%" src="<?php echo '/user_profile_photo/' . $profile_photo ?>" />
            <?php
          } else {
            ?>
            <img id="avatar" style="max-height:100%; max-width:100%" src="user_profile_photo/Profile-empty.png" />
            <?php
          }
          ?>
        </div>
      </td>

      <td class="col_2nd" rowspan="2"></td>

      <td class="col_3rd" rowspan="2">
        <div id="div_editor" style="width: auto; word-wrap:break-word;">
          <div  id="final_text_english" style="display: block;">
            <?php
            echo $profile_text_en;
            ?>
          </div>
          <div  id="final_text_japanese" style="display: none;">
            <?php
            echo $profile_text_jap;
            ?>
          </div>
          <div  id="final_text_chinese" style="display: none;">
            <?php
            echo $profile_text_ch;
            ?>
          </div>
          <form method="post">
            <div id="show_editor_english" style="display:none;">
              <textarea id="editor_english">
                <?php  echo $profile_text_en; ?>
              </textarea>
            </div>
            <div id="show_editor_japanese" style="display:none;">
              <textarea id="editor_japanese">
                <?php echo $profile_text_jap; ?>
              </textarea>
            </div>
            <div id="show_editor_chinese" style="display:none;">
              <textarea id="editor_chinese">
                <?php echo $profile_text_ch; ?>
              </textarea>
            </div>
          </form>
        </div>
      </td>

      <td class="col_4th" rowspan="2"></td>

      <td class="col_5th" rowspan="2">
        <div id="button_to_edit" style="display:none">
          <input id="input_id" type="file" hidden/>
          <button type="submit" id="button_upload_photo" class="btn btn-outline-secondary" style="width: 100%; height:40px; padding: 0px; margin: 10px 0px;">upload photo</button>
          <button type="submit" id="button_edit_english" class="btn btn-outline-secondary" style="width: 100%; height:40px; padding: 0px; margin: 10px 0px;">edit English</button>
          <button type="submit" id="button_edit_japanese" class="btn btn-outline-secondary" style="width: 100%; height:40px; padding: 0px; margin: 10px 0px;">edit Japanese</button>
          <button type="submit" id="button_edit_chinese" class="btn btn-outline-secondary" style="width: 100%; height:40px; padding: 0px; margin: 10px 0px;">edit Chinese</button>
        </div>
      </td>

      <td class="col_6th" rowspan="2"></td>
    </tr>

    <tr>
      <td class="col_1st">
        <div id="div_langu_option" style="position:relative; width:120px; height:auto;background-color:white; margin: 0 auto;">

          <table style="width:100%">
            <tr style="height:10px">
              <td style="width:100%">
              </td>
            </tr>
            <tr>
              <td style="width:100%">
                <button type="button" id="language_en" class="btn btn-outline-secondary" style="width:100%; height:40px; background-color:white;padding: 0px; margin: 0px 0px;">EN</button>
              </td>
            </tr>
            <tr style="height:10px">
              <td style="width:100%">
              </td>
            </tr>
            <tr>
              <td style="width:100%">
                <button type="button" id="language_jp" class="btn btn-outline-secondary" style="width:100%; height:40px; background-color:white;padding: 0px; margin: 0px 0px;">JP</button>
              </td>
            </tr>
            <tr style="height:10px">
              <td style="width:100%">
              </td>
            </tr>
            <tr>
              <td style="width:100%">
                <button type="button" id="language_cn" class="btn btn-outline-secondary" style="width:100%; height:40px; background-color:white;padding: 0px; margin: 0px 0px;">CN</button>
              </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
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
          <div class="img-container">
            <img id="popup_ima_frame">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="btn btn-default" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" id="button_on_popupframe" class="btn btn-outline-secondary" id="crop">Crop</button>
        </div>
      </div>
    </div>
  </div>
</body>


<script>
if (sessionStorage.getItem('user_identity')=='pi') {

  var button_to_edit = document.getElementById('button_to_edit');
  button_to_edit.style.display = 'block';


  function openDialog() {
    document.getElementById('input_id').click();
  }
  document.getElementById('button_upload_photo').addEventListener('click', openDialog);
  window.addEventListener('DOMContentLoaded', function () {
    var avatar = document.getElementById('avatar');
    var image = document.getElementById('popup_ima_frame');
    var input = document.getElementById('input_id');
    var $modal = $('#modal');
    var cropper;
    input_id.addEventListener('change', function (e) {
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
        if (URL) {
          done(URL.createObjectURL(file));
        } else if (FileReader) {
          reader = new FileReader();
          reader.onload = function (e) {
            done(reader.result);
          };
          reader.readAsDataURL(file);
        }
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
          url: 'profile_save_cropped_ima_pi.php',
          data: {
            pass_cropped_canvas : canvas.toDataURL(),
            pass_user_id:user_id
          },
          success: function(data) {
            // console.log(data);
          }
        });
      }
    });

    document.getElementById('button_edit_english').addEventListener('click', function () {
      if (document.getElementById("button_edit_english").innerHTML === "save") {
        var returned_text_english = tinyMCE.get('editor_english').getContent({format: 'raw'})

        document.getElementById("button_edit_english").innerHTML = "edit English";
        document.getElementById("button_edit_japanese").disabled = false;
        document.getElementById("button_edit_chinese").disabled = false;
        document.getElementById("language_en").disabled = false;
document.getElementById("language_cn").disabled = false;
document.getElementById("language_jp").disabled = false;

        var show_editor_english = document.getElementById("show_editor_english");
        show_editor_english.style.display = "none";

        var show_editor_chinese = document.getElementById("show_editor_chinese");
        show_editor_chinese.style.display = "none";

        var show_editor_japanese = document.getElementById("show_editor_japanese");
        show_editor_japanese.style.display = "none";

        document.getElementById("final_text_english").innerHTML = returned_text_english;
        returned_text_english = returned_text_english.replace(/"/g, 'REPLACE');

        var final_text_english = document.getElementById("final_text_english");
        final_text_english.style.display = "block";

        var final_text_japanese = document.getElementById("final_text_japanese");
        final_text_japanese.style.display = "none"

        var final_text_chinese = document.getElementById("final_text_chinese");
        final_text_chinese.style.display = "none"

        $.ajax({
          type: "POST",
          url: 'profile_save_content_pi.php',
          data: {
            pass_text :returned_text_english,
            pass_type :"English",
            pass_user_id:user_id
          },
          success: function(data) {
            console.log(user_id);
            console.log(data);
          }
        });
      } else if (document.getElementById("button_edit_english").innerHTML === "edit English") {
        document.getElementById("button_edit_japanese").disabled = true;
        document.getElementById("button_edit_chinese").disabled = true;
        document.getElementById("button_edit_english").innerHTML = "save";
        document.getElementById("language_en").disabled = true;
document.getElementById("language_cn").disabled = true;
document.getElementById("language_jp").disabled = true;


        var final_text_english = document.getElementById("final_text_english");
        final_text_english.style.display = "none";

        var final_text_japanese = document.getElementById("final_text_japanese");
        final_text_japanese.style.display = "none";

        var final_text_chinese = document.getElementById("final_text_chinese");
        final_text_chinese.style.display = "none";

        var show_editor_english = document.getElementById("show_editor_english");
        show_editor_english.style.display = "block"

        var show_editor_chinese = document.getElementById("show_editor_chinese");
        show_editor_chinese.style.display = "none";

        var show_editor_japanese = document.getElementById("show_editor_japanese");
        show_editor_japanese.style.display = "none";
      }
    });


    document.getElementById('button_edit_japanese').addEventListener('click', function () {
      if (document.getElementById("button_edit_japanese").innerHTML === "save") {
        var returned_text_japanese = tinyMCE.get('editor_japanese').getContent({format: 'raw'})
        document.getElementById("button_edit_japanese").innerHTML = "edit Japanese";
        document.getElementById("button_edit_english").disabled = false;
        document.getElementById("button_edit_chinese").disabled = false;
        document.getElementById("language_en").disabled = false;
document.getElementById("language_cn").disabled = false;
document.getElementById("language_jp").disabled = false;

        var show_editor_japanese = document.getElementById("show_editor_japanese");
        show_editor_japanese.style.display = "none";

        var show_editor_chinese = document.getElementById("show_editor_chinese");
        show_editor_chinese.style.display = "none";

        var show_editor_english = document.getElementById("show_editor_english");
        show_editor_english.style.display = "none";

        document.getElementById("final_text_japanese").innerHTML = returned_text_japanese;
        returned_text_japanese = returned_text_japanese.replace(/"/g, 'REPLACE');

        var final_text_japanese = document.getElementById("final_text_japanese");
        final_text_japanese.style.display = "block";

        var final_text_chinese = document.getElementById("final_text_chinese");
        final_text_chinese.style.display = "none";

        var final_text_english = document.getElementById("final_text_english");
        final_text_english.style.display = "none";

        $.ajax({
          type: "POST",
          url: 'profile_save_content_pi.php',
          data: {
            pass_text :returned_text_japanese,
            pass_type :"Japanese",
            pass_user_id:user_id
          },
          success: function(data) {
            console.log(data);
          }
        });
      } else if (document.getElementById("button_edit_japanese").innerHTML === "edit Japanese") {
        document.getElementById("button_edit_english").disabled = true;
        document.getElementById("button_edit_chinese").disabled = true;
        document.getElementById("button_edit_japanese").innerHTML = "save";
        document.getElementById("language_en").disabled = true;
document.getElementById("language_cn").disabled = true;
document.getElementById("language_jp").disabled = true;

        var final_text_english = document.getElementById("final_text_english");
        final_text_english.style.display = "none";

        var final_text_japanese = document.getElementById("final_text_japanese");
        final_text_japanese.style.display = "none";

        var final_text_chinese = document.getElementById("final_text_chinese");
        final_text_chinese.style.display = "none";

        var show_editor_japanese = document.getElementById("show_editor_japanese");
        show_editor_japanese.style.display = "block";

        var show_editor_english = document.getElementById("show_editor_english");
        show_editor_english.style.display = "none";

        var show_editor_chinese = document.getElementById("show_editor_chinese");
        show_editor_chinese.style.display = "none";

      }
    });


    document.getElementById('button_edit_chinese').addEventListener('click', function () {
      if (document.getElementById("button_edit_chinese").innerHTML === "save") {

        var returned_text_chinese = tinyMCE.get('editor_chinese').getContent({format: 'raw'})
        document.getElementById("button_edit_chinese").innerHTML = "edit Chinese";
        document.getElementById("button_edit_japanese").disabled = false;
        document.getElementById("button_edit_english").disabled = false;
        document.getElementById("language_en").disabled = false;
document.getElementById("language_cn").disabled = false;
document.getElementById("language_jp").disabled = false;

        var show_editor_chinese = document.getElementById("show_editor_chinese");
        show_editor_chinese.style.display = "none";

        var show_editor_english = document.getElementById("show_editor_english");
        show_editor_english.style.display = "none";

        var show_editor_japanese = document.getElementById("show_editor_japanese");
        show_editor_japanese.style.display = "none";

        document.getElementById("final_text_chinese").innerHTML = returned_text_chinese;
        returned_text_chinese = returned_text_chinese.replace(/"/g, 'REPLACE');

        var final_text_chinese = document.getElementById("final_text_chinese");
        final_text_chinese.style.display = "block";

        var final_text_english = document.getElementById("final_text_english");
        final_text_english.style.display = "none";

        var final_text_japanese = document.getElementById("final_text_japanese");
        final_text_japanese.style.display = "none";

        $.ajax({
          type: "POST",
          url: 'profile_save_content_pi.php',
          data: {
            pass_text :returned_text_chinese,
            pass_type :"Chinese",
            pass_user_id:user_id
          },
          success: function(data) {
            console.log(data);
          }
        });
      } else if (document.getElementById("button_edit_chinese").innerHTML === "edit Chinese") {
        document.getElementById("button_edit_english").disabled = true;
        document.getElementById("button_edit_japanese").disabled = true;
        document.getElementById("button_edit_chinese").innerHTML = "save";
        document.getElementById("language_en").disabled = true;
document.getElementById("language_cn").disabled = true;
document.getElementById("language_jp").disabled = true;

        var final_text_english = document.getElementById("final_text_english");
        final_text_english.style.display = "none";

        var final_text_japanese = document.getElementById("final_text_japanese");
        final_text_japanese.style.display = "none";

        var final_text_chinese = document.getElementById("final_text_chinese");
        final_text_chinese.style.display = "none"

        var show_editor_chinese = document.getElementById("show_editor_chinese");
        show_editor_chinese.style.display = "block";

        var show_editor_english = document.getElementById("show_editor_english");
        show_editor_english.style.display = "none";

        var show_editor_japanese = document.getElementById("show_editor_japanese");
        show_editor_japanese.style.display = "none";
      }
    });


  });
}

//language_en language_jp language_cn   //final_text_chinese  final_text_english final_text_japanese
document.getElementById('language_en').addEventListener('click', function () {
  var final_text_english = document.getElementById("final_text_english");
  final_text_english.style.display = "block";

  var final_text_japanese = document.getElementById("final_text_japanese");
  final_text_japanese.style.display = "none";

  var final_text_chinese = document.getElementById("final_text_chinese");
  final_text_chinese.style.display = "none";
});
document.getElementById('language_jp').addEventListener('click', function () {
  var final_text_english = document.getElementById("final_text_english");
  final_text_english.style.display = "none";

  var final_text_japanese = document.getElementById("final_text_japanese");
  final_text_japanese.style.display = "block";

  var final_text_chinese = document.getElementById("final_text_chinese");
  final_text_chinese.style.display = "none";
});
document.getElementById('language_cn').addEventListener('click', function () {
  var final_text_english = document.getElementById("final_text_english");
  final_text_english.style.display = "none";

  var final_text_japanese = document.getElementById("final_text_japanese");
  final_text_japanese.style.display = "none";

  var final_text_chinese = document.getElementById("final_text_chinese");
  final_text_chinese.style.display = "block";
});

</script>












</html>
