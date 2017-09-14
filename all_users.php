<?php
// вся процедура основана на сессиях, нужно подключить их в самом начале страницы !!!
session_start();

include ("blocks/bd.php");

if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
{
//если существует логин и пароль в сессиях, проверям действительные ли они
$login = $_SESSION['login'];
$password = $_SESSION['password'];
$result2 = mysql_query("SELECT id FROM users WHERE login='$login' AND password='$password' AND activation='1'",$db); 
$myrow2 = mysql_fetch_array($result2); 
if (empty($myrow2['id']))
   {
   //если данные неверные
    exit("Вход на эту страницу разрешен только зарегистрированным пользователям!");
   }
}
else {
//проверка входа зарегистрированных
exit("Вход на эту страницу разрешен только зарегистрированным пользователям!"); }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Пользователи</title>
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
                        <? echo $myrow["text"]; ?>
                        <div class="margin">
<h2>Список пользователей</h2>


<?php
//выводим меню

print <<<HERE
|<a href='page.php?id=$_SESSION[id]'>Моя страница</a>|<a href='index.php'>Главная страница</a>|<a href='all_users.php'>Список пользователей</a>|<a href='exit.php'>Выход</a><br><br>
HERE;

$result = mysql_query("SELECT login,id FROM users WHERE activation=1 ORDER BY login ",$db); 
$myrow = mysql_fetch_array($result);
do
{

    printf("<a href='page.php?id=%s'>%s</a><br>",$myrow['id'],$myrow['login']);
}
while($myrow = mysql_fetch_array($result));

?>
                        </div>
        </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>
</body>
</html>
