<?php
session_start();
include ("blocks/bd.php");

if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
{

$login = $_SESSION['login'];
$password = $_SESSION['password'];
$result2 = mysql_query("SELECT id FROM users WHERE login='$login' AND password='$password' AND activation='1'",$db); 
$myrow2 = mysql_fetch_array($result2); 
if (empty($myrow2['id']))
   {
   //данные неверные
    exit("Вход на эту страницу разрешен только зарегистрированным пользователям!");
   }
}
else {
//Проверка зарегистрированный ли пользователь
exit("Вход на эту страницу разрешен только зарегистрированным пользователям!"); }
$id2 = $_SESSION['id']; //получаем id


if (isset($_GET['id'])) { $id = $_GET['id'];}

$result = mysql_query("SELECT poluchatel FROM messages WHERE id='$id'",$db); 
$myrow = mysql_fetch_array($result); 

if ($login == $myrow['poluchatel']) {

$result = mysql_query ("DELETE FROM messages WHERE id = '$id' LIMIT 1");
if ($result == 'true') {
echo "<html><head><meta http-equiv='Refresh' content='5; URL=page.php?id=".$id2."'></head><body>Ваше сообщение удалено! Вы будете перенаправлены через 5 сек. Если не хотите ждать, то <a href='page.php?id=".$id2."'> нажмите сюда.</a></body></html>";
}
else {
echo "<html><head><meta http-equiv='Refresh' content='5; URL=page.php?id=".$id2."'></head><body>Ошибка! Ваше сообщение не удалено. Вы будете перенаправлены через 5 сек. Если не хотите ждать, то <a href='page.php?id=".$id2."'> нажмите сюда.</a></body></html>"; }

}
else {exit("Вы пытаетесь удалить сообщение, которое отправлено не вам! ");} 
?>