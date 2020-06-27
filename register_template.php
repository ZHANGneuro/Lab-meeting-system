

<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <title>*** lab</title>

<script src="/js_library/jquery-3.3.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>


<script type="text/javascript">
var status_email = 0;
var status_password = 0;
var status_membername = 0;
var status_identity = 0;
</script>

<style>

#feedback {
  width: 300px;
  /* height: 30px; */
  margin: 5% auto auto auto;
}

#background {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 340px;
  height:500px;
  margin: 0% auto auto auto;

  display: -webkit-box;  /* OLD - iOS 6-, Safari 3.1-6, BB7 */
  display: -ms-flexbox;  /* TWEENER - IE 10 */
  display: -webkit-flex; /* NEW - Safari 6.1+. iOS 7.1+, BB10 */
  display: flex;         /* NEW, Spec - Firefox, Chrome, Opera */
  justify-content: center;
  /* text-align: center; */
}

#email {
  width: 250px;
  margin: 15% auto auto auto;
}
#confirm_email {
  width: 250px;
  margin: 0% auto auto auto;
}
#psw {
  width: 250px;
  margin: 0% auto auto auto;
}
#confirm_psw {
  width: 250px;
  margin: 0% auto auto auto;
}

#membername {
  width: 250px;
  margin: 0% auto auto auto;
}

#identity_label {
  width: 250px;
  margin: 10% auto auto auto;
}
#radio1 {
  width: 250px;
  margin: 0% auto auto auto;
}
#radio2 {
  width: 250px;
  margin: 0% auto auto auto;
}

#btn_register {
  width: 200px;
  margin: 10% auto auto auto;
}



</style>

<div class="form-group text-center" id="feedback" style="color:red"></div>

<div id="background" class="shadow-lg p-3 mb-5 bg-white rounded">
  <form method="post" class="login-form">

    <div class="form-group text-center">
      <input type="text" class="form-control" id="email" placeholder="email address (username)">
    </div>

    <div class="form-group text-center">
      <input type="text" class="form-control" id="confirm_email" placeholder="confirm email address">
    </div>

    <div class="form-group text-center">
      <input type="password" class="form-control" id="psw" placeholder="password">
    </div>

    <div class="form-group text-center">
      <input type="password" class="form-control" id="confirm_psw" placeholder="confirm password">
    </div>

    <div class="form-group text-center">
      <input type="text" class="form-control" id="membername" placeholder="your name in English or Pinyin">
    </div>

    <div id="identity_label">
      <a><font size="3">Choose your identity</font></a>
    </div>

    <div id="radio1" class="custom-control custom-radio">
      <input type="radio" id="customRadio_student" name="customRadio" class="custom-control-input">
      <label class="custom-control-label" for="customRadio_student">I am student</label>
    </div>
    <div id="radio2" class="custom-control custom-radio">
      <input type="radio" id="customRadio_pi" name="customRadio" class="custom-control-input">
      <label class="custom-control-label" for="customRadio_pi">I am PI</label>
    </div>

    <div class="form-group text-center">
      <button type="submit" id="btn_register" class="btn btn-outline-secondary">Register</button>
    </div>

  </form>
</div>






<script type="text/javascript">
$(document).ready(function($) {
  $('#btn_register').on( 'click', function (e) {
    e.preventDefault();
    var email = document.getElementById('email').value;
    var confirm_email = document.getElementById('confirm_email').value;
    var psw = document.getElementById('psw').value;
    var confirm_psw = document.getElementById('confirm_psw').value;
    var member_name = document.getElementById('membername').value;
    var checkbox_pi = document.getElementById('customRadio_pi').checked;
    var checkbox_student = document.getElementById('customRadio_student').checked;


    // check email
    if (!confirm_email | !email) {
      document.getElementById("feedback").innerHTML = "'email address' cannot be empty";
    } else {
      if (confirm_email !== email) {
        document.getElementById("feedback").innerHTML = "email addresses do not match";
      }
      if (confirm_email == email) {
        status_email = 1;
      }
    }

    // check password
    if (!psw | !confirm_psw) {
      document.getElementById("feedback").innerHTML = "'password' cannot be empty";
    } else {
      if (psw !== confirm_psw) {
        document.getElementById("feedback").innerHTML = "passwords do not match";
      }
      if (psw == confirm_psw) {
        status_password = 1;
      }
    }

    // check name
    if (!member_name) {
      document.getElementById("feedback").innerHTML = "'your name' cannot be empty";
    } else {
      status_membername = 1;
    }

    // check identity
    if (!checkbox_student & !checkbox_pi) {
      document.getElementById("feedback").innerHTML = "choose your identity";
    } else {
      if (checkbox_pi == 1 && checkbox_student == 0) {
        status_identity = 1;
        var user_identity = 'pi';
      } else if (checkbox_pi == 0 && checkbox_student == 1) {
        status_identity = 1;
        var user_identity = 'student';
      }
    }







    // all ok
    if (status_email==1 & status_password==1 & status_membername == 1 & status_identity==1) {
      $.ajax({
        type: "POST",
        url: "registration_function.php",
        data: {
          pass_email : email,
          pass_password : psw,
          pass_membername : member_name,
          pass_identity : user_identity
        },
        success: function(data) {
          var returned = $.trim(data);
          console.log(data);
          if (returned === 'yes') {
            document.getElementById("feedback").innerHTML = "your registeration form has been submited, please wait for an email notification from administrator. \n now you can close this page.";
            var temp_feedback = document.getElementById("feedback");
            temp_feedback.style.color = '#086375';
          }
          if (returned === 'exist') {
            document.getElementById("feedback").innerHTML = "email address already exists, use another one.";
          }
        }
      });
    }

  });
});

</script>

</html>
