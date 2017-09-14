<? include ("blocks/bd.php");

$result = mysql_query("SELECT title,meta_d,meta_k,text FROM settings WHERE page='about'",$db);

if (!$result)
{
echo "<p>Запрос на выборку данных из базы не прошел. Напишите об этом администратору  <br> <strong>Код ошибки:</strong></p>";
exit(mysql_error());
}

if (mysql_num_rows($result) > 0)

{
$myrow = mysql_fetch_array($result); 
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
<title>О нас</title>
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
        
        </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>

</body>
</html>
