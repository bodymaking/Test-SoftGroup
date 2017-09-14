<?php 
include ("lock.php");
include ("blocks/bd.php");
if (isset($_GET['id'])) {$id = $_GET['id'];}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Редактировать категорию</title>
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
$result = mysql_query("SELECT title,id FROM categories");      
$myrow = mysql_fetch_array($result);

do 
{
printf ("<p><a href='edit_cat.php?id=%s'>%s</a></p>",$myrow["id"],$myrow["title"]);
}

while ($myrow = mysql_fetch_array($result));

}

else

{

$result = mysql_query("SELECT * FROM categories WHERE id=$id");      
$myrow = mysql_fetch_array($result);

echo "<h3 align='center'>Редактирование записи</h3>";

print <<<HERE

<form name='form1' method='post' action='update_cat.php'>
         <p>
           <label>Введите название записи<br>
             <input value="$myrow[title]" type="text" name="title" id="title">
             </label>
         </p>
         <p>
           <label>Введите краткое описание записи<br>
           <input value="$myrow[meta_d]" type="text" name="meta_d" id="meta_d">
           </label>
         </p>
         <p>
           <label>Введите ключевые слова записи<br>
           <input value="$myrow[meta_k]" type="text" name="meta_k" id="meta_k">
           </label>
         </p>
        
         <p>
           <label>Введите полный текст записи с тегами абзацов<br>
           <textarea name="text" id="text" cols="40" rows="20">$myrow[text]</textarea>
           </label>
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
