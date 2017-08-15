<?php
session_start();
session_destroy();

?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>tprinfo</title>
  
  <link rel="icon" href="tprinfo/img/favicon.png" type="image/x-icon">
  <script type="text/javascript" src="tprinfo/js/login.js"></script>
  <link href="tprinfo/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="tprinfo/css/index_style.css"> 
  <script src="tprinfo/js/bootstrap.min.js"></script>

</head>

<body>
  <hgroup>
    <h1>tprinfo &#9996;</h1>
    <h3>Your TAP cell members need to know about you.</h3>
    <em>Your Registration Number is your default password (All Uppercase)</em><br>
    <em>Change your default password to one of your own choice as soon as you log in</em>
  </hgroup>
<form>
  <div class="group">
    <input type="text" id="id"><span class="highlight" ></span><span class="bar"></span>
    <label>Registration Number</label>
  </div>
  <div class="group">
    <input type="password" id="password"><span class="highlight" ></span><span class="bar"></span>
    <label>Password</label>
  </div>
  <div id="error_display" style="width: 100%; margin-left: auto; margin-right: auto; display: block;"></div>
  <button type="button" class="button buttonBlue" onclick="login();">Log In
    <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
  </button>
</form>
<footer>
 <p>Designed with all the &#9829; in the world by <a href="https://www.linkedin.com/in/iamrishiraj/" target="_blank">Rishiraj Mehta</a></p>
</footer>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script type="text/javascript" src="tprinfo/js/index.js"></script>
  <script src="tprinfo/js/bootstrap.min.js"></script>
</body>
</html>
