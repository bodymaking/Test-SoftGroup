<? include ("blocks/bd.php");
if (isset($_GET['date']))
{
$date = $_GET['date'];
}
else 
{
exit("<p>Вы обратились к файлу без необходимых параметров. Проверьте адресную строку браузера.");
}
$date_title = $date;

$date_begin = $date;
$date++;
$date_end = $date;

$date_begin = $date_begin."-01";
$date_end = $date_end."-01";




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
<? 
		
			
        
        $result = mysql_query("SELECT id,title,description,date,author,view,file FROM data WHERE activation=1 AND date>'$date_begin' AND date<'$date_end'",$db);

if (!$result)
{
echo "<p>Запрос на выборку данных из базы не прошел. Напишите об этом администратору  <br> <strong>Код ошибки:</strong></p>";
exit(mysql_error());
}

if (mysql_num_rows($result) > 0)

{
$myrow = mysql_fetch_array($result);
$id_com = $myrow['id'];
                $comment = mysql_query("SELECT COUNT(*) AS 'count' FROM comments WHERE post='$id_com'",$db);
            if (!$comment)
            {
              echo "<p> !!Запрос на выборку данных из базы не прошел.Пожалуйста сообщение администратору: ";
             exit(mysql_error());
             }
 
            $comments = mysql_fetch_array($comment, MYSQL_ASSOC);
    do
    {
       
        printf ('
					<div class="post_section">
						<h2 class="title-last-post"><a href="view_post.php?id=%s">%s</a></h2>
            %s| <strong>Автор:</strong> %s | <strong>Просмотры:</strong> %s| <strong>Коментарии:</strong> %s
             <img src="files/%s"/>
						<p class="description-last-post">%s</p>
						
              <a href="view_post.php?id=%s">Подробнее</a>
              
							</div>

				',$myrow["id"],$myrow["title"],$myrow["date"],$myrow["author"],$myrow["view"],$comments["count"],$myrow["file"],$myrow["description"],$myrow["id"],$r);


}
while ($myrow = mysql_fetch_array($result));



}

else
{
echo "<p>Информация по запросу не может быть извлечена в таблице нет записей.</p>";
exit();
}

?>
        
       </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>
</body>
</html>
