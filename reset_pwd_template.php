

<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <title>Naya lab</title>

<script src="/js_library/jquery-3.3.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>



<style>

#mydiv {
  width: 200px;
  margin: 5% auto auto auto;
  background-color: #FAD74F;
  width:300px;
  height: 100px;
  border: 0px solid #ccc;
  display: table;
}

.margin_left {
margin-left: 5%;
}
#feedback {
  width: 300px;
  /* height: 30px; */
  margin: 2% auto auto auto;
}
#background {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 340px;
  height:200px;
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

#btn_register {
  width: 200px;
  margin: 10% auto auto auto;
}
</style>



<div id="mydiv">
  <p></p>
  <p class="margin_left">Reset password procedure:</p>
  <ol>
     <li>send a temporal link to your email address.</li>
     <li>In your email inbox, click the link to reset password.</li>
  </ol>
</div>


<div class="form-group text-center" id="feedback" style="color:red"></div>

<div id="background" class="shadow-lg p-3 mb-5 bg-white rounded">
  <form method="post" class="login-form">

    <div class="form-group text-center">
      <input type="text" class="form-control" id="email" placeholder="email address">
    </div>

    <div class="form-group text-center">
      <button type="submit" id="btn_register" class="btn btn-outline-secondary">send link</button>
    </div>

  </form>
</div>






<script type="text/javascript">
$(document).ready(function($) {
  $('#btn_register').on( 'click', function (e) {
    e.preventDefault();
    var email = document.getElementById('email').value;

    // check email
    if (!email) {
      document.getElementById("feedback").innerHTML = "'email address' cannot be empty";
    }


    // all ok
    if (email) {
      $.ajax({
        type: "POST",
        url: "reset_pwd_generatetemp_sendemail.php",
        data: {
          pass_email : email
        },
        success: function(data) {
          var returned = $.trim(data);
          console.log(returned);
          if (returned == 'yes') {
            document.getElementById("feedback").innerHTML = "link has been sent, check your email inbox";
            var temp_feedback = document.getElementById("feedback");
            temp_feedback.style.color = '#086375';
          } else {
            document.getElementById("feedback").innerHTML = "problem, please contact bo";
            var temp_feedback = document.getElementById("feedback");
            temp_feedback.style.color = 'red';
          }
        }
      });
    }

  });
});

</script>

</html>
