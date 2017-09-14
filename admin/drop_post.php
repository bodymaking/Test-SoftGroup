<?php 
include ("lock.php");
include ("blocks/bd.php");
if (isset($_POST['id'])) {$id = $_POST['id'];}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Удалить запись</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="templatemo_wrapper">
<? $n=1; include ("blocks/nav.php"); ?>

<? include ("blocks/lefttd.php"); ?>
       

 <div id="templatemo_right_column">
  <div id="templatemo_main">
         <?php 
if (isset($id))
{
$result = mysql_query ("DELETE FROM data WHERE id='$id'");

if ($result == 'true') {echo "<p>Ваша заметка успешно удалена!</p>";}
else {echo "<p>Ваша заметка не удалена!</p>";}


}		 
else 

{
echo "<p>Вы запустили данный фаил без параметра id и поэтому, удалить заметку невозможно (скорее всего Вы не выбрали радиокнопку на предыдущем шаге).</p>";
}
		 
		 
		 
		 ?>
         
         
              </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>
</body>
</html>
