<?php 
error_reporting(0);
include 'connection.php';

global $state,$con;
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Meal Management</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style/style.css">
<!-- jquery cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>

<div class="sidenav">
  
   <a href="#" onclick="get_login_form();">Login</a>
   <a href="#" onclick="get_signup_form();">Sign Up</a>
   <a href="#" onclick="about_developer();" class="about_dev">About Developer</a>
  
</div>

<div class="content" id="main_login">
  <h1>Wellcome To Meal Management</h1>
  <p>Full Dynamic And Powerfull Application For Managing Cost and Meal for any Organization</p>
</div>
<script src="scripts/login.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>


  <?php 
  $state = $_REQUEST['state'];

  switch($state){
      case 'login':
         echo '@!#@';
         getLoginForm();
         echo '@!#@';
       break;
     case 'signup':
            echo '@!#@';
            getSignupForm();
            echo '@!#@';
       break;
      case 'developer_details':
        echo '@!#@';
        about();
        echo '@!#@';
        break;
    case 'userlogin':
       session_start();
        $user = $_REQUEST['user'];
        $pass = $_REQUEST['pass'];

        $sql = "SELECT id,username,fullname, password FROM users WHERE username='$user' AND password='$pass'";
        $r = mysqli_query($con, $sql);
        echo $sql;
        
        if(mysqli_num_rows($r)>0){
          $com=mysqli_fetch_assoc($r);
          echo '@!#@'.'1'.'@!#@Login Successful!@!#@';
          $_SESSION['current_user'] = $com['fullname'];
          $_SESSION['userid'] = $com['id'];
        }else{
          echo '@!#@'.'2'.'@!#@Username or Password is wrong!'.'@!#@';
        }
      break;
    case 'userSignup':
      $fname = $_REQUEST['user_fname'];
      $username = $_REQUEST['user_name'];
      $pass= $_REQUEST['user_pass'];
      $mobile = $_REQUEST['user_mobile'];
      $entrytime = date('d-m-Y');
      $sql = "INSERT INTO users(fullname,username,password,mobile,entrytime)VALUES(
        '$fname',
        '$username',
        '$pass',
        '$mobile',
        '$entrytime'
      )";
     $res= mysqli_query($con,$sql);
     if($res){
       echo '@!#@'.'Registration Successful!'.'@!#@';
     }else{
      echo '@!#@'.'Something Wrong!'.'@!#@';
     }
      break;
  }
  function getLoginForm(){
?>
    <form name="login_form" action="post" enctype="multipart/form-data">
        <h1>Login</h1>
      <input type="text" name="username" placeholder="Username">
      <br><br>
      <input type="password" name="password" placeholder="Password">
      <br><br>
      <input type="button" value="Login" onclick="login_query();">
      <br><br>
      <span style="color: red;" id="login_msg"></span>
    </form>

 <?php }

 function getSignupForm(){

?>


<form name="signup_form" action="post" enctype="multipart/form-data">
        <h1>Sign Up</h1>
        <input type="text" name="fullname" placeholder="Full Name">
      <br><br>
      <input type="text" name="username" placeholder="Username">
      <br><br>
      <input type="password" name="password" placeholder="Password">
      <br><br>
      <input type="text" name="mobile" placeholder="Mobile No">
      <br><br>
      <input type="button" value="Sign Up" onclick="signup_query();">
      <br><br>
      <span id="sign_up_msg"></span>
    </form>

    <?php }
    function about(){
      ?>
   
<div class="card">
  <img src="images/ismail_hossain.png" alt="Ismail Hossain">
  <div class="card_container">
    <h4><b>Md Ismail Hossain</b></h4> 
    <p>Full Stack Developer</p>
    <p>Email: ihsojib43@gmail.com</p>
    <p></p>
  <a href="https://www.facebook.com/think.sojib/" target="_blank"><button>Facebook</button></a>
  <a href="https://www.linkedin.com/in/ihsojib-7a849a154/" target="_blank"><button>Linkedin</button></a>
  </div>
</div>

   <?php }
    ?>
</html>

