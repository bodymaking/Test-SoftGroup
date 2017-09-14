<?php
session_start();
include ("blocks/bd.php"); ?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Регистрация</title>
<link href="style.css" rel="stylesheet" type="text/css">
<meta name="description" content="<? echo $myrow["meta_d"]; ?>">
<meta name="keywords" content="<? echo $myrow["meta_k"]; ?>">
</head>

<body>
<div id="templatemo_wrapper">
<? $n=1; include ("blocks/nav.php"); ?>
<? include ("blocks/lefttd.php"); ?>
       

 <div id="templatemo_right_column">
  <div id="templatemo_main">

<?php

if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } 
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }

if (empty($login) or empty($password)) 
{
exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!"); 
}

$login = stripslashes($login);
$login = htmlspecialchars($login);

$password = stripslashes($password);
$password = htmlspecialchars($password);

//удаляем лишние пробелы
$login = trim($login);
$password = trim($password);



$ip=getenv("HTTP_X_FORWARDED_FOR");
if (empty($ip) || $ip=='unknown') { $ip=getenv("REMOTE_ADDR"); }

mysql_query ("DELETE FROM oshibka WHERE UNIX_TIMESTAMP() - UNIX_TIMESTAMP(date) > 900");

$result = mysql_query("SELECT col FROM oshibka WHERE ip='$ip'",$db);
$myrow = mysql_fetch_array($result);

if ($myrow['col'] > 2) {
exit ("Вы набрали логин или пароль неверно 3 раза. Подождите 15 минут до следующей попытки."); 


}

$password = md5($password);
$password = strrev($password);
$password = $password."b3p6f";


$result = mysql_query("SELECT * FROM users WHERE login='$login' AND password='$password' AND activation='1'",$db); 
$myrow = mysql_fetch_array($result);
if (empty($myrow['id']))
{

$select = mysql_query ("SELECT ip FROM oshibka WHERE ip='$ip'");
$tmp = mysql_fetch_row ($select);
if ($ip == $tmp[0]) {

$result52 = mysql_query("SELECT col FROM oshibka WHERE ip='$ip'",$db);
$myrow52 = mysql_fetch_array($result52);

$col = $myrow52[0] + 1;
mysql_query ("UPDATE oshibka SET col=$col,date=NOW() WHERE ip='$ip'");
}

else {
mysql_query ("INSERT INTO oshibka (ip,date,col) VALUES ('$ip',NOW(),'1')");
}

exit ("Вибачте, введений вами пароль аба логин невірний"); 

}
else {

          
          $_SESSION['password']=$myrow['password']; 
		  $_SESSION['login']=$myrow['login']; 
          $_SESSION['id']=$myrow['id'];
		  

if (isset($_POST['save'])){

setcookie("login", $_POST["login"], time()+9999999);
setcookie("password", $_POST["password"], time()+9999999);
setcookie("id", $myrow['id'], time()+9999999);
}

if (isset($_POST['autovhod'])){

setcookie("auto", "yes", time()+9999999);
setcookie("login", $_POST["login"], time()+9999999);
setcookie("password", $_POST["password"], time()+9999999);
setcookie("id", $myrow['id'], time()+9999999);}
}	

echo "<html><head><meta http-equiv='Refresh' content='0; URL=authorization.php'></head></html>";


?>

     </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>


</body>
</html>