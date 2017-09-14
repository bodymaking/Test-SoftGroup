<?php 
include ("lock.php");
include ("blocks/bd.php");
if (isset($_GET['id'])) {$id = $_GET['id'];}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Редактировать неактивированную запись</title>
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
      
<? 

if (!isset($id))

{
$result = mysql_query("SELECT title,id FROM data WHERE activation=0");
$myrow = mysql_fetch_array($result);

do 
{
printf ("<p><a href='edit_post_activation.php?id=%s'>%s</a></p>",$myrow["id"],$myrow["title"]);
}

while ($myrow = mysql_fetch_array($result));

}

else

{

$result = mysql_query("SELECT * FROM data WHERE id=$id");      
$myrow = mysql_fetch_array($result);

$result2 = mysql_query("SELECT id,title FROM categories");      
$myrow2 = mysql_fetch_array($result2);

$count = mysql_num_rows($result2);

echo "<h3 align='center'>Редактирование неактивированной записи</h3>";

echo "<form name='form1' method='post' action='update_post_activate.php'>
 <p>Выберите категорию для заметки<br><select name='cat' size='$count'>";

do 
{

if ($myrow['cat'] == $myrow2['id'])
{
printf ("<option value='%s' selected>%s</option>",$myrow2["id"],$myrow2["title"]);
}

else
{
printf ("<option value='%s'>%s</option>",$myrow2["id"],$myrow2["title"]);
}

}
while ($myrow2 = mysql_fetch_array($result2));
 
echo "</select></p><br>"; 
 

print <<<HERE

         <p>
           <label>Введите название записи<br>
             <input value="$myrow[title]" type="text" name="title" id="title">
             </label>
         </p>
         <p>
           <label>Введите краткое описание<br>
           <input value="$myrow[meta_d]" type="text" name="meta_d" id="meta_d">
           </label>
         </p>
         <p>
           <label>Введите ключевые слова записи<br>
           <input value="$myrow[meta_k]" type="text" name="meta_k" id="meta_k">
           </label>
         </p>
         <p>
           <label>Введите дату добавления записи<br>
           <input value="$myrow[date]" name="date" type="text" id="date" value="2007-01-27">
           </label>
         </p>
         <p>
           <label>Введите краткое описание с тегами абзацов<br>
           <textarea name="description" id="description" cols="40" rows="5">$myrow[description]</textarea>
           </label>
         </p>
         <p>
           <label>Введите повний текст записи з тегами<br>
           <textarea name="text" id="text" cols="40" rows="20">$myrow[text]</textarea>
           </label>
         </p>
         <p>
           <label>Введите автора записи<br>
           <input value="$myrow[author]" type="text" name="author" id="author">
           </label>
         </p>
         <p>
           <label>Email автора<br>
           <input value="$myrow[email]" type="text" name="email" id="email">
           </label>
         </p>
         <p>
            <label for="Activation">Активация</label><br>
            <input id="activation" type="radio" name="activation" value="0" checked>0<Br>
            <input id="activation" type="radio" name="activation" value="1">1<Br>
            </p>
		 
		 <input name="id" type="hidden" value="$myrow[id]">
		 
         <p>
           <label>
           <input type="submit" name="submit" id="submit" value="Сохранить">
           </label>
         </p>
       </form>



HERE;
}


?>
       
       
       </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>
</body>
</html>
