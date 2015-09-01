<?php include ("./inc/connect.inc.php"); 
session_start();
if (!isset($_SESSION["user_login"])) {
  # code...
}
else
{
  header("location:home.php");
 
}

?>
<!DOCTYPE html><?php
$reg = @$_POST['reg'];
//declaring variables to prevent errors
$fn = ""; //First Name
$ln = ""; //Last Name
$un = ""; //Username
$em = ""; //Email
$pswd = ""; //Password
$pswd2 = ""; // Password 2
$d = ""; // Sign up Date
//registration form
$fn = strip_tags(@$_POST['fname']);
$ln = strip_tags(@$_POST['lname']);
$un = strip_tags(@$_POST['username']);
$em = strip_tags(@$_POST['email']);
$pswd = strip_tags(@$_POST['password']);
$pswd2 = strip_tags(@$_POST['password2']);
$d = date("Y-m-d"); // Year - Month - Day
if (isset($reg)) {

$u_check = mysql_query("SELECT username FROM users WHERE username='$un'");
// Count the amount of rows where username = $un
$check = mysql_num_rows($u_check);
//Check whether Email already exists in the database
$e_check = mysql_query("SELECT email FROM users WHERE email='$em'");
//Count the number of rows returned
$email_check = mysql_num_rows($e_check);
if ($check == 0) {
  if ($email_check == 0) {
//check all of the fields have been filed in
if ($fn&&$ln&&$un&&$em&&$pswd&&$pswd2) {
// check that passwords match
if ($pswd==$pswd2) {
// check the maximum length of username/first name/last name does not exceed 25 characters
if (strlen($un)>25||strlen($fn)>25||strlen($ln)>25) {
echo "The maximum limit for username/first name/last name is 25 characters!";
}
else
{
// check the maximum length of password does not exceed 25 characters and is not less than 5 characters
if (strlen($pswd)>30||strlen($pswd)<5) {
echo "Your password must be between 5 and 30 characters long!";
}
else
{
//encrypt password and password 2 using md5 before sending to database
$pswd = md5($pswd);
$pswd2 = md5($pswd2);
$query = mysql_query("INSERT INTO users VALUES ('','$un','$fn','$ln','$em','$pswd','$d','0')");
header("location:home.php");
 $_SESSION["id"] = $id;
     $_SESSION["user_login"] = $user_login;
     $_SESSION["password_login"] = $password_login;
         exit("<meta http-equiv=\"refresh\" content=\"0\">");
}
}
}
else {
echo "Your passwords don't match!";
}
}
else
{
echo "Please fill in all of the fields";
}
}
else
{
 echo "Sorry, but it looks like someone has already used that email!";
}
}
else
{
echo "Username already taken ...";
}
}
//LoginScript
if (isset($_POST["user_login"]) && isset($_POST["password_login"])) {
  $user_login = $_POST["user_login"]; // filter everything but numbers and letters
    $password_login =  $_POST["password_login"]; // filter everything but numbers and letters
  $md5password_login = md5($password_login);
    $sql = mysql_query("SELECT id FROM users WHERE username='$user_login' AND password='$md5password_login'"); // query the person
  //Check for their existance
  $userCount = mysql_num_rows($sql); //Count the number of rows returned
  
  if ($userCount == 1) {
    while($row = mysql_fetch_array($sql)){ 
             $id = $row["id"];
  }
     $_SESSION["id"] = $id;
     $_SESSION["user_login"] = $user_login;
     $_SESSION["password_login"] = $password_login;
         exit("<meta http-equiv=\"refresh\" content=\"0\">");
    } else {
    echo 'That information is incorrect, try again';
    exit();
  }
}



?>
<html>
<head>
    <title>Our Adda-Login</title>
    <link rel="stylesheet" type="text/css" href="./bootstrap-3.3.2-dist/css/bootstrap.min.css">
    <link rel="SHORTCUT ICON" HREF="./res/favicon.ico">
    <style type="text/css">
    @font-face{
        font-family: Bebas Neue;
    }
    body{
    background-color: #008c75;
    }
    .sign-up-wrapper{
         width: 40em;
         padding-left: 50px;
    }
    .heading-signup{
        width: 100%;
        padding-bottom: 10px;
    }
    .heading-signup h1{
        font-weight: bolder;
    }
    .logo{
        
        padding-bottom: 5px;
    }
    .wrapper{
        margin-left: 15%;
        padding-top: 5%;
        width: 25em;
    }
    .heading h1{
        text-align: center;
        font-weight: bolder;
    }
    .form-wrapper{
        height: 18.75em;
        width: 25em;
        background: #fff;
        text-transform: uppercase;
        font-family: "Bebas Neue", Arial;
        color: #fff;
    }
    .form-wrapper> div{
        height: 6.25em;
        width: 100%;
    }
    .username {
         background-color: #4daf7c;
    }
    .username::after {
    content: "";
    width: 0;
    height: 0;
    position: absolute;
    border-style: solid;
    border-width: 0.5em 0.469em 0 0.469em;
    border-color: #4daf7c transparent transparent transparent;
    margin-top: 15%;
    top: 22.95em;
    margin-left: 15%;
    left: 9.5em;
}
    .password {
     background-color: #404241;
}
    .password:after{
        content: "";
    width: 0;
    height: 0;
    position: absolute;
    border-style: solid;
    border-width: 0.5em 0.469em 0 0.469em;
    border-color: #404241 transparent transparent transparent;
    margin-top: 15%;
    top: 29.20em;
    margin-left: 15%;
    left: 9.5em;

    }
    .login {
  background-color: #e9c85d;
  display: table;
}
.login:hover{
    background-color: #f7d97e;
}
.login input {
  
  display: table-cell;
  
  font-size:3em;
  cursor: pointer;
  height: 1.2em;
  border:0;
  margin-top: 0.2em;

}
.signup-button{
    margin-top: 0;
    border:0;
    height: 1.75em;
    width: 100%;
 background-color: #ff6e49;
  display: table;   
}
.signup-button:hover{
    background-color: #ff8466;
}
input {
  height: 1.25em;
  width: 100%;
  font-size: 1.8em;
  text-align:center;
  
  outline: 0;
  color: #fff;
  background: transparent;
  border:0.033em #fff solid;
  
  margin-top: 1em;
  font-family: "Bebas Neue", Arial;
}
.form{
    width: 80%;
}

.input-group .form-control {
    margin: 0px;
}

::placeholder {
  color: #fff;
}

::-moz-placeholder {
  color: #fff;
}

:-ms-input-placeholder {
  color: #fff;
}

::-webkit-input-placeholder {
  color: #fff;
}
.input-group{
    padding-bottom: 15px;
}
div.vertical-line{
  position: relative;
  width: 2px; /* Line width */
  background-color: rgba(64,66,65,0.5); /* Line color */
  height: 100%; /* Override in-line if you want specific height. */
  position: absolute; /* Causes the line to float to left of content. 
    You can instead use position:absolute or display:inline-block
    if this fits better with your design */
    
    top: 10%;
}
   </style>


</head>
<body>
    <div class="wrapper col-md-6 col-xs-8">
        <div class="heading"><h1>Welcome To</h1></div>
        <div class="logo"><img src="./res/full-logo_3d.png"></div>
        <form class="form-wrapper" action="#" method="post">
            
                
                    <div class="username">
                        <input type="text" name="user_login" placeholder="Username">
                    </div>
                
                
                    <div class="password">
                        <input type="password" name="password_login" placeholder="Password">
                    </div>
                
                <div class="login">
                    <input type="submit">
                </form>
               
        </div>
    </div>
    <div class="vertical-line col-md-offset-6 col-xs-offset-9" style="height: 500px;" />
    <div class="sign-up-wrapper col-md-offset-6 col-md-6 col-xs-9 col-xs-offset-9">
        <div class="heading-signup"><h1>Not a part of an Adda?<br>Create one!</h1></div>
    
        <form class="form" action="#" method="post">
             <div class="input-group">
                 <span class="input-group-addon">First Name</span>
                <input type="text" name="fname" class="form-control" placeholder="Enter First Name" style="height:100%;" value="<?php echo htmlspecialchars($fn); ?>" />
            
            </div>
            <div class="input-group">
                 <span class="input-group-addon">Last Name</span>
                <input type="text" name="lname" class="form-control" placeholder="Enter Last Name"  value="<?php echo $ln; ?>" style="height:100%;">
            
            </div>
            <div class="input-group">
                 <span class="input-group-addon">Email Address</span>
                <input type="email" name="email"class="form-control" placeholder="Enter Email"  value="<?php echo $em; ?>"style="height:100%;">
            
            </div>
            <div class="input-group">
                 <span class="input-group-addon">Username</span>
                <input type="text" name="username"class="form-control" placeholder="Enter Username"  value="<?php echo $un; ?>"style="height:100%;">
            
            </div>
            <div class="input-group">
                 <span class="input-group-addon">Password</span>
                <input type="password" name="password" class="form-control" placeholder="Enter Password" style="height:100%;">
            
            </div>
            <div class="input-group">
                 <span class="input-group-addon">Re-enter Password</span>
                <input type="password" name="password2" class="form-control" placeholder="Re-enter Password" style="height:100%;">
            
            </div>
          
          <input class="signup-button" name="reg" type="submit" value="Sign Up" style="font-size:3em;">
        </form>    
        
    
    </div>
</body>
</html>
