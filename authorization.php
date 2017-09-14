<? session_start();
include ("blocks/bd.php");

if (isset($_COOKIE['auto']) and isset($_COOKIE['login']) and isset($_COOKIE['password']))
if (isset($_COOKIE['auto']) and isset($_COOKIE['login']) and isset($_COOKIE['password']))
{
    if ($_COOKIE['auto'] == 'yes') { 
        $_SESSION['password']=strrev(md5($_COOKIE['password']))."b3p6f"; 
        $_SESSION['login']=$_COOKIE['login'];
        $_SESSION['id']=$_COOKIE['id'];
    }
}

if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
{

    $login = $_SESSION['login'];
    $password = $_SESSION['password'];
    $result = mysql_query("SELECT id,avatar FROM users WHERE login='$login' AND password='$password' AND activation='1'",$db);
    $myrow = mysql_fetch_array($result);
//извлекаем нужные данные о пользователе
}

$result3 = mysql_query("SELECT title,meta_d,meta_k,text FROM settings WHERE page='authorization'",$db);

if (!$result3)
{
echo "<p>Запрос на выборку данных из базы не прошел. Напишите об этом администратору  <br> <strong>Код ошибки:</strong></p>";
exit(mysql_error());
}

if (mysql_num_rows($result3) > 0)

{
$myrow3 = mysql_fetch_array($result3);
}

else
{
echo "<p>Информация по запросу не может быть обработана, в базе нету записей</p>";
exit();
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Авторизация</title>
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
        <?php
        if (!isset($myrow['avatar']) or $myrow['avatar']=='') {









            print <<<HERE
            <section class="container">
    <div class="login">
      <h1>Войти в личный кабинет</h1>
<form action="testreg.php" method="post">
<!-- testreg.php - обработчик авторизации методом "post"  -->
  <p>
     <p><input type="text" name="login" value="" placeholder="Логин или Email"></p>
HERE;


            if (isset($_COOKIE['login'])) 
            {

                echo ' value="'.$_COOKIE['login'].'">';
            }


            print <<<HERE
  
<!-- В текстове поле (name="login" type="text") пользователь вводит свой логин -->
  <p><input type="password" name="password" value="" placeholder="Пароль"></p>
        
HERE;


            if (isset($_COOKIE['password']))
            {

             echo ' value="'.$_COOKIE['password'].'">';
            }

            print <<<HERE
 
<!-- В поле для паролей (name="password" type="password") пользователь вводит свой пароль -->
 
          <label>
            <input type="checkbox" name="remember_me" id="remember_me">
            Запомнить меня
          </label>
        </p>

<p class="submit"><input type="submit" name="commit" value="Войти">
<div class="login-help">
      <a href="send_pass.php">Забыли пароль?</a> Восстановите его!
    </div>
</p>

 
 
<br>


</form>
 </section>
<br>
Вы ввойшли как гость <br> <a href='#'> Эта ссылка доступна только зарегестрированным пользователям </a>
HERE;
        }

        else {
            


            print <<<HERE
<div class="margin">
|<a href='page.php?id=$_SESSION[id]'>Моя страница</a>|<a href='index.php'>Главная страница</a>|<a href='all_users.php'>Список пользователей</a>|<a href='exit.php'>Выход</a><br><br>


Вы ввошли на сайт как $_SESSION[login]<br>

Ваш аватар:<br>
<img alt='$_SESSION[login]' src='$myrow[avatar]'><br>
<a href='http://google.com/'>Эта ссылка доступна только зарегестрированным пользователям</a>



</div>

HERE;
        }
?>
        </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>

</body>
</html>
