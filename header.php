
<html>


<head>
  <script src="/js_library/jquery-3.3.1.js"></script>
  <script type="text/javascript">
  $(document).ready(function($) {
    $('#click_loginout').on( 'click', function (e) {
      sessionStorage.setItem('login_status','out') ;
      sessionStorage.setItem('user_identity','normal') ;
      sessionStorage.setItem('perm','member') ;
    });
  });
</script>
</head>


<style>
div.brand {
  position: relative;
  text-align: center;
  top:20px;
  font-size: 2em;
}
div.brand a {
  text-decoration: none;
  color:black;
}
div.navigator {
  position: relative;
  top:40px;
  color:black;
}
div.navigator nav li a{
  color:black;
  font-size: 1.2em;
}
#home_area:hover{
  text-decoration: underline;
}
#research_area:hover{
  text-decoration: underline;
}
#people_area:hover{
  text-decoration: underline;
}
#pub_area:hover{
  text-decoration: underline;
}
#login_area:hover{
  text-decoration: underline;
}
#pending_list_area:hover{
  text-decoration: underline;
}
#lmr_area:hover{
  text-decoration: underline;
}
.dropdown-item:hover{
  text-decoration: underline;
}
.dropdown .dropdown-menu{
  display: block;
   visibility: hidden;
   opacity: 0;
   transition:         all 0.05s  ease;
   -moz-transition:    all 0.05s  ease;
   -webkit-transition: all 0.05s  ease;
   -o-transition:      all 0.05s  ease;
   -ms-transition:     all 0.05s  ease;
}
.dropdown:hover>.dropdown-menu {
  visibility: visible;
  opacity: 1;
}
.dropdown {
  display: inline-block;
}
#footer {
  position:fixed;
  bottom: 0%;
  width: 100%;
  text-align: center;
  width:100%;
  height:40px;
  background: white;
  z-index: 1000;
  padding:0 0 0 0;
  border-top:1px solid black;
}
#footer div{
  position:relative;
  color:black;
  font-size: 1.2em;
  top: 5px;
}
</style>



<body>

  <div class="brand">
    <a href="./index.php"><font face="Arial" size="6">*** lab</font></a>
  </div>

  <div class="navigator">
    <nav class="nav nav-pills justify-content-center" style="background-color: #e3f2fd;">

      <div id="home_area">
        <li class="nav-item">
          <a class="nav-link" href="./index.php">Home</a>
        </li>
      </div>

      <div id="research_area">
        <li class="nav-item">
          <a class="nav-link" href="research_template.php">Research</a>
        </li>
      </div>

      <div id="people_area">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">People</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="profile_pi.php">PI</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="profile_student.php">Students</a>
          </div>
        </li>
      </div>

      <div id="pub_area">
        <li class="nav-item">
          <a class="nav-link" href="publication_template.php">Publication</a>
        </li>
      </div>

      <div id="lmr_area" style="display: none">
        <li class="nav-item">
          <a class="nav-link" href="lab_meeting_records_mainpage.php">Lab meeting</a>
        </li>
      </div>

      <div id="pending_list_area" style="display: none">
        <li class="nav-item">
          <a class="nav-link" href="pending_list.php">Pending List</a>
        </li>
      </div>

      <div id="login_area">
        <li class="nav-item">
          <a class="nav-link" href="login_template.php">Login</a>
        </li>
      </div>

    </nav>
  </div>

  <div id="footer">
    <div>Room ***, *** building, *** University, *** road No.***, *** district, Beijing</div>
  </div>
</body>



<script type="text/javascript">

if (sessionStorage.getItem('login_status') == 'in'){
  document.getElementById("login_area").innerHTML = '<li class="nav-item"><a id="click_loginout" class="nav-link" href="./">Log out</a></li>';
} else if (sessionStorage.getItem('login_status') == 'out') {
  document.getElementById("login_area").innerHTML = '<li class="nav-item"><a id="click_login" class="nav-link" href="login_template.php">Login</a></li>';
} else{
  document.getElementById("login_area").innerHTML = '<li class="nav-item"><a id="click_login" class="nav-link" href="login_template.php">Login</a></li>';
}

if (sessionStorage.getItem('login_status') == 'in'){
  var js_lmr = document.getElementById("lmr_area");
js_lmr.style.display = "block";
} else{
  var js_lmr = document.getElementById("lmr_area");
  js_lmr.style.display = "none";
}

if (sessionStorage.getItem('perm') == 'admin'){
  var js_pendinglist = document.getElementById("pending_list_area");
  js_pendinglist.style.display = "block";
} else{
  var js_pendinglist = document.getElementById("pending_list_area");
  js_pendinglist.style.display = "none";
}
</script>


</html>
