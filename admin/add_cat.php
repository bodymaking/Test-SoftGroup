<?php 
include ("lock.php");
include ("blocks/bd.php");
if (isset($_POST['title']))       
{
$title = $_POST['title']; 

if ($title == '') 
{
unset($title);
}  

}

/* Если существует в глобальном массиве $_POST['title'] опр. ячейка, то мы создаем простую переменную из неё. Если переменная пустая, то уничтожаем переменную.   */
if (isset($_POST['meta_d']))      {$meta_d = $_POST['meta_d']; if ($meta_d == '') {unset($meta_d);}}
if (isset($_POST['meta_k']))      {$meta_k = $_POST['meta_k']; if ($meta_k == '') {unset($meta_k);}}
if (isset($_POST['text']))        {$text = $_POST['text']; if ($text == '') {unset($text);}}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Добавление категории</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="templatemo_wrapper">
<? $n=1; include ("blocks/nav.php"); ?>

<? include ("blocks/lefttd.php"); ?>
       

 <div id="templatemo_right_column">
  <div id="templatemo_main">
      
         <?php 
if (isset($title) && isset($meta_d) && isset($meta_k) && isset($text))
{
/* Здесь пишем что можно заносить информацию в базу */
$add_cat = mysql_query ("INSERT INTO categories (title,meta_d,meta_k,text) VALUES ('$title', '$meta_d','$meta_k','$text')");

if ($add_cat == 'true') {echo "<p>Ваша категория успешно добавлена!</p>";}
else {echo "<p>Ваша категория не добавлена!</p>";}


}		 
else 

{
echo "<p>Вы ввели не всю информацию, поэтому категория в базу не может быть добавлена.</p>";
}
		 
		 
		 
		 ?>
         
         
             </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>
</body>
</html>
