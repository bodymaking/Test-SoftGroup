<?php
include ("blocks/bd.php");?>

<body>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><? echo $myrow["title"]; ?></title>
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
$result4 =    mysql_query    ("SELECT avatar FROM    users WHERE activation='0'    AND    UNIX_TIMESTAMP()    - UNIX_TIMESTAMP(date)    > 3600");//извлекаем аватарки тех пользователей, которые в    течении часа не активировали свой аккаунт. Следовательно их надо удалить из    базы, а так же и файлы их аватарок
 if    (mysql_num_rows($result4) > 0) {
            $myrow4    = mysql_fetch_array($result4);  
            do 
            {

            //удаляем    аватары в цикле, если они не стандартные
            if    ($myrow4['avatar'] == "avatars/net-avatara.jpg") {$a = "Ничего    не делать";}
            else    {
                     unlink ($myrow4['avatar']);//удаляем    файл
                     }
            }

            while($myrow4    = mysql_fetch_array($result4));
            }
            mysql_query    ("DELETE FROM users WHERE activation='0' AND UNIX_TIMESTAMP() -    UNIX_TIMESTAMP(date) > 3600");//удаляем пользователей из базы
 if    (isset($_GET['code'])) {$code =$_GET['code']; } //код подтверждения 
            else 
            {    exit("Вы    зашли на страницу без кода подтверждения!");} //если не указали code,    то выдаем ошибку
 if (isset($_GET['login'])) {$login=$_GET['login'];    } //логин,который    нужно активировать
            else 
            {    exit("Вы    зашли на страницу без логина!");} //если не указали логин, то выдаем ошибку
 $result = mysql_query("SELECT    id    FROM    users WHERE login='$login'",$db); //извлекаем    идентификатор пользователя с данным логином
            $myrow    = mysql_fetch_array($result); 
 $activation    = md5($myrow['id']).md5($login);//создаем    такой же код подтверждения
 if ($activation == $code) {//сравниваем полученный из url и сгенерированный код 
                     mysql_query("UPDATE    users SET activation='1' WHERE login='$login'",$db);//если равны, то активируем пользователя
                     echo "Ваш Е-мейл подтвержден! Теперь вы можете    зайти на сайт под своим логином! <a href='index.php'>Главная    страница</a>";
                     }
            else {echo "Ошибка! Ваш Е-мейл не    подтвержден! <a    href='index.php'>Главная    страница</a>";
            //если    же полученный из url и    сгенерированный код не равны, то выдаем ошибку
            }
            ?>
 </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>
</body>
</html>
