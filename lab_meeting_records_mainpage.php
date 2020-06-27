

<html>

<title>*** Lab</title>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<style>
td.edit_button {
  background: url("extend.png") no-repeat center center;
  cursor: pointer;
  background-size: 30px;
}
.table_title{
  text-align: center;
}
.send_email_row{
  text-align: center;
}
.col_1 {
  width: 24%;
  background-color: #E4B381;
  text-align:center;
}
.col_3 {
  width: 50%;
  background-color: #E4B381;
  text-align:center;
  vertical-align: top;
}
.col_5 {
  width: 24%;
  background-color: #E4B381;
  text-align:center;
  vertical-align: top;
}
.col_gap {
  width: 1%;
}
.email_edit_area{
  border: 1px solid #ccc;
}
.custom-file-upload{
  border: 1px solid #ccc;
  display: inline-block;
  padding: 10px 60px;
  cursor: pointer;
}
input[type="file"] {
  display: none;
}
.upload_form{
  position: absolute;
}
table tbody tr.smalltable td{
  background-color: white;
}
table tbody tr.smalltable td:hover {
  background: none;
}
#block_container {
  text-align: center;
}
#block_container > div {
  display: inline-block;
  vertical-align: middle;
}
</style>

<?php
include('header.php');
?>

<script>
var editor_id_ith = 0;
var click_row_id = 0;
var js_emailing_list_array = [];
var member_name = sessionStorage.getItem('member_name');

js_emailing_list_array.push("josem@mac.com");
js_emailing_list_array.push("ajohnson@yahoo.ca");
js_emailing_list_array.push("jugalator@comcast.net");
js_emailing_list_array.push("devphil@icloud.com");
js_emailing_list_array.push("duncand@hotmail.com");
js_emailing_list_array.push("bdthomas@me.com");
js_emailing_list_array.push("aukjan@sbcglobal.net");
js_emailing_list_array.push("bcevc@mac.com");
js_emailing_list_array.push("bo.zhang@pku.edu.cn");
js_emailing_list_array.push("schumer@gmail.com");
js_emailing_list_array.push("forsberg@msn.com");
js_emailing_list_array.push("bflong@comcast.net");
js_emailing_list_array.push("bartlett@me.com");
js_emailing_list_array.sort();
js_emailing_list_array.reverse();
</script>

<link rel="stylesheet" href="/datatables_js/jquery-ui.css" />
<link rel="stylesheet" href="/datatables_js/jquery.dataTables.min.css" />
<link rel="stylesheet" href="/datatables_js/buttons.dataTables.min.css" />
<link rel="stylesheet" href="/datatables_js/select.dataTables.min.css" />
<link rel="stylesheet" href="/datatables_js/editor.dataTables.min.css" />

<script type="text/javascript" charset="utf8" src="/tinymce_js/tinymce.min.js"></script>
<script type="text/javascript" charset="utf8" src="/datatables_js/jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8" src="/datatables_js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf8" src="/datatables_js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="/datatables_js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="/datatables_js/dataTables.select.min.js"></script>
<script type="text/javascript" charset="utf8" src="/datatables_js/dataTables.editor.min.js"></script>

<body>
  <div id="primary" style="position:absolute; width:75%; margin-left: auto;margin-right: auto;left: 0;right: 0; top: 20%; height:auto;">

    <div id="block_container">
      <button type="submit" id="addRow" class="btn btn-outline-secondary">add new record</button>
    </div>
    <br>

    <table id="labmeetingrecord" class="stripe" style="width:100%">
      <thead>
        <tr>
          <th class="table_title">ID</th>
          <th class="table_title">Date</th>
          <th class="table_title">Speaker</th>
          <th class="table_title">Article</th>
          <th class="table_title">Author</th>
          <th class="table_title">Journal</th>
          <th class="table_title">Send email</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    <div id="more_space" style="position:relative; height:100px;"></div>
  </div>


</body>

<script type="text/javascript">

var editor;
jQuery(document).ready(function($) {

  editor = new $.fn.dataTable.Editor( {
    ajax: "datatables_js/datatables_editor_instance.php",
    table: "#labmeetingrecord",
    fields: [
      {
        name: "ID"
      },
      {
        name: "Date",
        type:       'datetime',
        dateFormat: $.datepicker.ISO_8601,
        def:        function () { return new Date(); }
      },
      {
        name: "Speaker"
      },
      {
        name: "Article"
      },
      {
        name: "Author"
      },
      {
        name: "Journal"
      }
    ]
  } );

  var table = $('#labmeetingrecord').DataTable({
    "order": [[ 1, "desc" ]],
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": false,
    "searching": true,
    ajax: "datatables_js/datatables_editor_instance.php",
    columns: [
      { data: "ID",
      "className":      'table_td' },
      { data: "Date",
      "className":      'table_td' },
      { data: "Speaker",
      "className":      'table_td' },
      { data: "Article",
      "className":      'table_td' },
      { data: "Author",
      "className":      'table_td'},
      { data: "Journal",
      "className":      'table_td'},
      {
        "className":      'edit_button',
        "orderable":      false,
        "data":           null,
        "defaultContent": ''
      }
    ],
    "columnDefs": [
      { "width": "0%", "targets": 0 },
      { "width": "15%", "targets": 1 },
      { "width": "10%", "targets": 2 },
      { "width": "40%", "targets": 3 },
      { "width": "10%", "targets": 4 },
      { "width": "10%", "targets": 5 },
      { "width": "15%", "targets": 6 },
      {targets: 0,  className: 'dt-body-center', "visible": false},
      {targets: 1,  className: 'dt-body-center'},
      {targets: 2, className: 'dt-body-center'},
      {targets: 3, className: 'dt-body-left'},
      {targets: 4, className: 'dt-body-center'},
      {targets: 5, className: 'dt-body-center'},
      {targets: 6, className: 'dt-body-center'}
    ]
  });

  $('#labmeetingrecord tbody').on( 'click', 'td.table_td', function (e) {
    editor.inline( this, {
      onBlur: 'submit'
    } );
  } );

  function copy_file_to_server (num_of_remaining, files){
    if (num_of_remaining > 0){
      var file_ith = num_of_remaining-1;
      var f = files.item(file_ith);
      var formData = new FormData();
      formData.append('file', f);

      var percentComplete = 0;
      var num_row_file_table = document.getElementById("selectedFiles").rows.length;
      var progressbar_id = 'progressbar_id_' + num_row_file_table;

      document.getElementById('selectedFiles').innerHTML += '<tr width=70% style="font-size: 90%;"><th class="col1">' +  f.name + '</th><th id="'+progressbar_id+'" width=30% class="col2" style="color:black">uploading ' + percentComplete + '%' + '<br/></th></tr>';

      $.ajax({
        type: "POST",
        url: "lab_meeting_file_upload.php",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        xhr: function () {
          var f = files.item(file_ith);
          var xhr = new window.XMLHttpRequest();
          xhr.upload.addEventListener("progress", function (evt) {
            if (evt.lengthComputable) {
              percentComplete = evt.loaded / evt.total;
              percentComplete = parseInt(percentComplete * 100);
              if (percentComplete===100) {
              } else if (percentComplete<100) {
                document.getElementById(progressbar_id).innerHTML = 'uploading ' + percentComplete + '%';
              }
            }
          }, false);
          return xhr;
        },
        success: function(data) {
          var returned = $.parseJSON(data);
          var indicator_filename = returned[0];
          if (indicator_filename=="uploaded") {
            array_pre_paper_title.push(returned[1]);
            document.getElementById(progressbar_id).innerHTML = 'uploaded<br><a href="#/" class="tdelete" style="color:red;text-decoration: underline;">remove</a>';
          } else {
            document.getElementById("send_email_button").disabled = true;
            document.getElementById(progressbar_id).innerHTML = 'error<br><a href="#/" class="tdelete" style="color:red;text-decoration: underline;">' + indicator_filename + '</a>';
          }
          num_of_remaining -= 1;
          copy_file_to_server(num_of_remaining, files);
        }
      });
    }
  }

  var array_pre_paper_title = [];
  $('#labmeetingrecord tbody').on('change','tr.smalltable .child_table .col_1 .upload_files_id',function(){ //

    var files = document.getElementById('upload_files_id').files;
    if (files.length==0) {
      document.getElementById('selectedFiles').innerHTML = "";
    }
    var num_of_remaining = files.length;
    copy_file_to_server(num_of_remaining, files);
  });

  // delete files
  $("#labmeetingrecord tbody").on('click', 'tr.smalltable .child_table .col_1 .col2 .tdelete', function(e){    //$("#selectedFiles").on('click', '.tdelete', function(e){
    e.preventDefault();
    var del_paper_title = $(this).closest('tr').find(".col1").html();
    var index_title_in_array = array_pre_paper_title.indexOf(del_paper_title);
    array_pre_paper_title.splice(index_title_in_array,1);
    $(this).closest("tr").remove();
    the_ajax_delete_file_path = "lab_meeting_delete_uploaded_file.php";
    $.ajax({
      type: "POST",
      url: the_ajax_delete_file_path,
      data: {
        pass_paper_title : del_paper_title,
      },
      success: function(data) {
        document.getElementById("send_email_button").disabled = false;
        // alert(data);
      }
    });
  });


  $('#labmeetingrecord tbody').on('click', 'td.edit_button', function () {
    var tr = $(this).closest('tr');
    var temp_row_data = table.row( tr ).data();
    click_row_id = temp_row_data["ID"];
    var row = table.row( tr );
    if ( row.child.isShown() ) {
      row.child.hide();
      tr.removeClass('shown');
    }
    else {
      row.child(format()).show(); //format(row.data())
      $(row.child()).addClass('smalltable');
      tr.addClass('shown');
      var editor_selector = '#editor' + editor_id_ith;
      tinymce.init({
        selector: editor_selector,
        statusbar: false,
        menubar: false,
        theme: 'modern',
        plugins: "advlist lists image textcolor code paste",
        height: 300,
        toolbar: 'formatselect outdent indent bold italic strikethrough | forecolor backcolor | alignleft aligncenter alignright | numlist bullist'
      });
    }
  });

  $("#labmeetingrecord tbody").on('click', 'tr.smalltable #send_email_button', function(e){
    var email_content = tinyMCE.activeEditor.getContent({format: 'raw'});
    var email_title = document.getElementById("email_title").value;

    document.getElementById("send_email_button").disabled = true;
    document.getElementById('send_email_button').innerHTML = 'sending ...';

    $.ajax({
      type: "POST",
      url: "lab_meeting_send_email_fuction.php",
      data: {
        pass_email_list : js_emailing_list_array,
        pass_email_title: email_title,
        pass_email_content : email_content,
        pass_title_array : array_pre_paper_title,
        pass_speaker : member_name
      },
      success: function(data) {
        var send_email_button_backcolor = document.getElementById('send_email_button');
        send_email_button_backcolor.style.backgroundColor = "#6BA368";

        var send_email_button_color = document.getElementById('send_email_button');
        send_email_button_color.style.backgroundColor = "white";

        var send_email_button_innerHTML = document.getElementById('send_email_button');
        send_email_button_innerHTML.innerHTML = data;
      }
    });
  });


  $('#addRow').on( 'click', function (e) {
    e.preventDefault();
    the_ajax_delete_file_path = "lab_meeting_insert_new_row_to_mysql.php";
    $.ajax({
      type: "POST",
      url: the_ajax_delete_file_path,
      data: {
        pass_date: new Date(new Date().getFullYear(), 11, 31).toISOString().slice(0, 10).replace('T', ' '),
        pass_member_name : member_name
      },
      success: function(data) {
        table.ajax.reload();
      }
    });
  });

  $("#labmeetingrecord tbody").on('click', 'tr.smalltable #button_delete_row', function(e){
    e.preventDefault();
    the_ajax_delete_row_path = "lab_meeting_delete_row.php";
    $.ajax({
      type: "POST",
      url: the_ajax_delete_row_path,
      data: {
        pass_row_id : click_row_id,
      },
      success: function(data) {
        table.ajax.reload();
      }
    });
  });
});



function format ( ) {
  var mailing_list = '';
  for (var i = 0; i < js_emailing_list_array.length; i++) {
    mailing_list = mailing_list + '<tr style="border-style:none"><td>' + js_emailing_list_array[i] + '</td></tr>';
  }

  var default_editor_text = 'Dear all<br/><br>I will present attached paper in lab meeting.<br/><br> best regards<br/><br> ' + member_name;

  var top_gaps = ''
  for (var i = 0; i < 1; i++) {
    top_gaps = top_gaps + '<tr style="border-style:none"><td>&nbsp</td></tr>';
  }
  var botton_gaps = ''
  for (var i = 0; i < 1; i++) {
    botton_gaps = botton_gaps + '<tr style="border-style:none"><td>&nbsp</td></tr>';
  }


  editor_id_ith = editor_id_ith + 1;


  return  '<div class="shadow-lg p-3 mb-5 bg-white rounded"><table width:100%  cellpadding="0" cellspacing="0" class="child_table" border="0">'+top_gaps+

  '<tr style="border-style:none">'+
  // row 1 col 1
  '<th class="child_table col_1">'+
  'Attachment'+
  '</th>'+
  // row 1 col gap
  '<th class="child_table col_gap"></th>'+
  // row 1 col 3
  '<th class="child_table col_3">'+
  'Title & contents'+
  '</th>'+
  // row 1 col gap
  '<th class="child_table col_gap"></th>'+
  // row 1 col 5
  '<th valign="bottom" class="child_table col_5">'+
  'Emailing list'+
  '</th>'+
  '</tr>'+


  '<tr style="border-style:none">'+
  // row 2 col 1
  '<td class="child_table col_1" style="vertical-align: top;">'+
  '<label for="upload_files_id" class="custom-file-upload"> <font size="2.5">Upload files</font> </label>' +
  '<input type="file" size="60" class="upload_files_id" id="upload_files_id" style="width:0; height:0;" name="files" multiple></input>'+
  '<table id="selectedFiles"></table>'+
  '</td>'+
  // row 2 col gap
  '<td class="child_table col_gap"></td>'+
  // row 2 col 3
  '<td class="child_table col_3">'+
  '<table>'+
  '&nbsp'+
  '<tr style="border-style:none">'+
  '<input type="text" class="form-control" id="email_title" value="Lab meeting notice sent by ' + member_name +' ">'+
  '</tr>'+
  '&nbsp'+
  '<tr style="border-style:none">'+
  '<textarea id="' + "editor" + editor_id_ith + '">  '+ default_editor_text + '  </textarea>'+
  '</tr>'+
  '</table>'+
  '</td>'+
  // row 2 col gap
  '<td class="child_table col_gap"></td>'+
  // row 2 col 5
  '<td class="child_table col_5">'+
  '<table id="subtable" border="0">'+
  mailing_list +
  '</table>' +
  '</td>'+
  '</tr>'+

  '<tr style="border-style:none">' +
  // row 3 col 1
  '<td class="child_table col_1"></td>'+
  // row 2 col gap
  '<td class="child_table col_gap"></td>'+
  // row 3 col 3
  '<td class="child_table col_3"></td>'+
  // row 2 col gap
  '<td class="child_table col_gap"></td>'+
  // row 3 col 5
  '<td class="child_table col_5"></td>'+
  '</tr>'+


  '<tr style="border-style:none">' +
  // row 5 col 1
  '<td class="child_table col_1"></td>'+
  // row 5 col gap
  '<td class="child_table col_gap"></td>'+
  // row 5 col 3
  '<td class="send_email_row"><button id="button_delete_row" type="submit" id="btn_register" class="btn btn-outline-secondary">delete</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="send_email_button" type="submit" id="btn_register" class="btn btn-outline-secondary">send email</button></td>'+
  // row 5 col gap
  '<td class="child_table col_gap"></td>'+
  // row 5 col 5
  '<td class="child_table col_5"></td>'+
  '</tr>'+
  // botton_gaps+
  '</table></div>';
}

</script>



</html>
