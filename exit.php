<?php
session_start();
if (empty($_SESSION['login']) or empty($_SESSION['password'])) 
{

exit ("Доступ разрешен только зарегистрированным пользователям. Если вы зарегистрированы, то войдите на сайт под своим логином и паролем<br><a href='index.php'>Главная страница</a>");
}

unset($_SESSION['password']);
unset($_SESSION['login']); 
unset($_SESSION['id']);

setcookie("auto", "", time()+9999999);
exit("<html><head><meta http-equiv='Refresh' content='0; URL=index.php'></head></html>");

?>