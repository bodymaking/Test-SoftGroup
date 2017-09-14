<? include ("blocks/bd.php");  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Новая запись</title>
<link href="style.css" rel="stylesheet" type="text/css">
 <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>

<body>
<div id="templatemo_wrapper">
<? $n=1; include ("blocks/nav.php"); ?>
<? include ("blocks/lefttd.php"); ?>
       

 <div id="templatemo_right_column">
  <div id="templatemo_main">
       <form enctype="multipart/form-data" name="form1" method="post" action="add_post.php">




         <p>
           <label>Введите название записи<br>
             <input type="text" name="title" id="title">
             </label>
         </p>
         <p>
           <label>Введите краткое описание<br>
           <input type="text" name="meta_d" id="meta_d">
           </label>
         </p>
         <p>
           <label>Введите ключевые слова<br>
           <input type="text" name="meta_k" id="meta_k">
           </label>
         </p>
         <p>
           <label>Введите дату добавления записи<br>
           <input name="date" type="text" id="date" value="<?php $date = date("Y-m-d"); echo $date; ?>">
           </label>
         </p>
         <p>
           <label>Введите краткое описание с тегами абзацов<br>
           <textarea name="description" id="description" cols="40" rows="5"></textarea>
           </label>
         </p>

         <p>
           <label>Введите автора записи<br>
           <input type="text" name="author" id="author">
           </label>
         </p>
         
         <p>
           <label>Выберите категорию записи<br>
           
           <select name="cat">
           
           <?
		   
       $result = mysql_query("SELECT title,id FROM categories",$db);

if (!$result)
{
echo "<p>Запрос на выборку данных из базы не прошел. Напишите об этом администратору  <br> <strong>Код ошибки:</strong></p>";
exit(mysql_error());
}

if (mysql_num_rows($result) > 0)

{
$myrow = mysql_fetch_array($result); 

do 
{
printf ("<option value='%s'>%s</option>",$myrow["id"],$myrow["title"]);



}
while ($myrow = mysql_fetch_array($result));



}

else
{
echo "<p>Информация по запросу не может быть извлечена в таблице нет записей.</p>";
exit();
}

?>
       
       
       
           </select>
           
           </label>
         </p>   
         
         
         <p>
           <label>
           <input type="submit" name="submit" id="submit" value="Добавить запись">
           </label>
         </p>
       </form>
       <p>&nbsp;</p>        </td>
      </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>
</body>
</html>
