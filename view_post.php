<? include ("blocks/bd.php");
if (isset($_GET['id'])) {$id = $_GET['id']; }
if (!isset($id)) {$id = 1;}


/* Проверяем, является ли переменная числом */
if (!preg_match("|^[\d]+$|", $id)) {
exit ("<p>Неверный формат запроса! Проверьте URL!");
}

$result = mysql_query("SELECT * FROM data WHERE id='$id'",$db);

if (!$result)
{
echo "<p>Запрос на выборку данных из базы не прошел. Напишите об этом администратору  <br> <strong>Код ошибки:</strong></p>";
exit(mysql_error());
}

if (mysql_num_rows($result) > 0)

{
$myrow = mysql_fetch_array($result); 
$id_com = $myrow['id'];
$login = $myrow['id_login'];
                $comment = mysql_query("SELECT COUNT(*) AS 'count' FROM comments WHERE post='$id_com'",$db);
            if (!$comment)
            {
              echo "<p> !!Запрос на выборку данных из базы не прошел.Пожалуйста сообщение администратору: ";
             exit(mysql_error());
             }
 
            $comments = mysql_fetch_array($comment, MYSQL_ASSOC);

$new_view = $myrow["view"] + 1;
$update = mysql_query ("UPDATE data SET view='$new_view' WHERE id='$id'",$db);


}

else
{
echo "<p>Информация по запросу не может быть извлечена в таблице нет записей.</p>";
exit();
}


?>

<?php
$id=$_GET["id"];
if (isset($_GET["fool"])){$fool=$_GET["fool"];}
?>
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
    <div class="post_section">
        <?

printf ("<h2>%s</h2> %s| <strong>Автор:</strong> %s | <strong>Просмотры:</strong> %s| <strong>Коментарии:</strong> %s<img src='files/%s'/><p class='view_description'>%s</p>",$myrow["title"],$myrow["date"],$myrow["author"],$myrow["view"],$comments["count"],$myrow["file"],$myrow["text"]);
?>
</div>




 <div class="comment_tab">
                Коментарии           </div>
<?


$result3 = mysql_query ("SELECT * FROM comments WHERE post='$id'",$db);
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

$result4 = mysql_query ("SELECT img FROM comments_setting",$db);
$myrow4 = mysql_fetch_array($result4);

$result5 = mysql_query ("SELECT login FROM users WHERE id='$login'",$db);
$myrow5 = mysql_fetch_array($result5);
print <<<HERE
  <div id="comment_form">

                    <h3>Оставить коментарий</h3>
<form action='comment.php' method='post' >
 <div class="form_row">
                            <label><strong>Имя</strong> </label>
                    <br />
                            <input type="text" name="author" value="$myrow5[login]" />
                        </div>
<div class="form_row">
                            <label><strong>Текст</strong></label>
                    <br />
                            <textarea  name="text" rows="" cols=""></textarea>
                        </div>
 <label><strong>Введите сумму чисел с картинки</strong> </label><br><img style='margin-top:17px;' src="$myrow4[img]" width="80" height="40">
  <input style='margin-bottom:16px;' name="pr" type="text" size="5" maxlength="5"></p>
  <input name="id" type="hidden" value="$myrow[id]">
 <input type="submit" name="sub_com" value="Коментировать" class="submit_btn" />


</form>
       </div>
HERE;
?>

        </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>

</body>
</html>
