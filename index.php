<?  session_start();
include ("blocks/bd.php");

$result = mysql_query("SELECT title,meta_d,meta_k,text FROM settings WHERE page='index'",$db);

if (!$result)
{
echo "<p>Запрос на выборку данных из базы не прошел. Напишите об этом администратору  <br> <strong>Код ошибки:</strong></p>";
exit(mysql_error());
}

if (mysql_num_rows($result) > 0)

{
$myrow = mysql_fetch_array($result);
}

else {
    echo "<td>Информация по запросу не может быть обработана, в базе нету записей</td>";
    exit();

}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Главная</title>
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
            <?php
            
            $result3 = mysql_query("SELECT id,title,author,date,description,view,file FROM data WHERE activation=1 ORDER BY id DESC LIMIT 5",$db);

            if (!$result3)
            {
                echo "<p>Запрос на выборку данных из базы не прошел. Напишите об этом администратору  <br> <strong>Код ошибки:</strong></p>";
                exit(mysql_error());
            }


            if (mysql_num_rows($result3) > 0)

            {
                $myrow3 = mysql_fetch_array($result3);
                $id_com = $myrow3['id'];
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

				',$myrow3["id"],$myrow3["title"],$myrow3["date"],$myrow3["author"],$myrow3["view"],$comments["count"],$myrow3["file"],$myrow3["description"],$myrow3["id"]);
				



                }
                while ($myrow3 = mysql_fetch_array($result3));



            }

            else
            {
                echo "<p>Информация по запросу не может быть обработана, в базе нету записей</p>";

            }

            ?>



      </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>


</body>
</html>
