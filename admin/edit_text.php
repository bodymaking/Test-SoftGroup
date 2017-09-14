<?php 
include ("lock.php");
include ("blocks/bd.php");
if (isset($_GET['id'])) {$id = $_GET['id'];}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Редактировать страницу</title>
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
<p><strong>Выберите страницу для редактирования</strong></p>
<? 

if (!isset($id))

{
$result = mysql_query("SELECT title,id FROM settings");      
$myrow = mysql_fetch_array($result);

do 
{
printf ("<p><a href='edit_text.php?id=%s'>%s</a></p>",$myrow["id"],$myrow["title"]);
}

while ($myrow = mysql_fetch_array($result));

}

else

{

$result = mysql_query("SELECT * FROM settings WHERE id=$id");      
$myrow = mysql_fetch_array($result);

print <<<HERE

<form name="form1" method="post" action="update_text.php">
         <p>
           <label>Введите название страницы (тэг title)<br>
             <input value="$myrow[title]" type="text" name="title" id="title">
             </label>
         </p>
         <p>
           <label>Введите краткое описание страницы<br>
           <input value="$myrow[meta_d]" type="text" name="meta_d" id="meta_d">
           </label>
         </p>
         <p>
           <label>Введите ключевые слова страницы<br>
           <input value="$myrow[meta_k]" type="text" name="meta_k" id="meta_k">
           </label>
         </p>
        
         <p>
           <label>Введите повний текст страницы с тегами
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
