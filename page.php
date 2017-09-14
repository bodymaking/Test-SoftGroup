<?php

session_start();

include ("blocks/bd.php");
if (isset($_GET['id'])) {$id =$_GET['id']; } 
else
{ exit("Вы зашил на страницу без параметра!");} 
if (!preg_match("|^[\d]+$|", $id)) {
exit("<p>Неверный формат запроса! Проверьте URL</p>");
}

if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
{

$login = $_SESSION['login'];
$password = $_SESSION['password'];
$result2 = mysql_query("SELECT id FROM users WHERE login='$login' AND password='$password' AND activation='1'",$db); 
$myrow2 = mysql_fetch_array($result2); 
if (empty($myrow2['id']))
   {
   
    exit("Вход на эту страницу разрешен только зарегистрированным пользователям!");
   }
}
else {

exit("Вход на эту страницу разрешен только зарегистрированным пользователям!"); }
$result = mysql_query("SELECT * FROM users WHERE id='$id'",$db);
$myrow = mysql_fetch_array($result);
if (empty($myrow['login'])) { exit("Пользователя не существует! Возможно он был удален.");} 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Моя страница</title>
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
<h2>Пользователь "<?php echo $myrow['login']; ?>"</h2>


<?php
print <<<HERE
|<a href='page.php?id=$_SESSION[id]'>Моя страница</a>|<a href='index.php'>Главная страница</a>|<a href='all_users.php'>Список пользователей</a>|<a href="new_post.php?id=$_SESSION[id]">Добавить новую запись</a>|<a href="my_articles.php">Мои записи</a>|<a href='exit.php'>|Выход|</a><br><br>
HERE;

$login=$myrow['login'];
if ($myrow['login'] == $login) {

echo
print <<<HERE
<form action='update_user.php' method='post'>
Ваш логин <strong>$myrow[login]</strong>. <br>Изменить логин:<br>
<input name='login' type='text'>
<input type='submit' name='submit' value='Изменить'>
</form>
<br>
<form action='update_user.php' method='post'>
Изменить пароль:<br>
<input name='password' type='password'>
<input type='submit' name='submit' value='Изменить'>
</form>
<br>
<form action='update_user.php' method='post' enctype='multipart/form-data'>
Ваш аватар:<br>
<img alt='аватар' src='$myrow[avatar]'><br>
Изображение должно быть формата jpg, gif или png. Изменить аватар:<br>
<input type="FILE" name="fupload">
<input type='submit' name='submit' value='Изменить'>
</form>
<br>
HERE;
print <<<HERE

<div class="comment_tab">
                Ваши коментарии           </div>
HERE;
$result3 = mysql_query ("SELECT * FROM comments WHERE author='$login'",$db);
if (mysql_num_rows($result3) > 0)
{
$myrow3 = mysql_fetch_array($result3);



do 
{
printf ("<div id='comment_section'>
        <ol class='comments first_level'>
         <li>
          <div class='comment_box commentbox1'>
           <div class='gravatar'>
                                    <img src='images/avator.png' alt='author' />
                                </div>
          <div class='comment_text'>
          <div class='comment_author'>%s<span class='date'>%s</span></div>
                                    
<p>%s</p></li></ol></div>",$myrow3["author"], $myrow3["date"], $myrow3["text"]);

}
while ($myrow3 = mysql_fetch_array($result3));


}
					
}

?>
</div>
 </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>
</body>
</html>
