 

  <div id="templatemo_left_column">
    
        <div id="templatemo_header">
         <div id="site_title">
                <h1><a href="#" target="_parent">Test <strong>by Buryakov</strong><span>For Soft Group</span></a></h1>
            </div><!-- end of site_title -->
            
            
        </div> <!-- end of header -->  
        <div id="templatemo_sidebar">
       
 
 <h4>Категории</h4>
 <?
 $result2 = mysql_query("SELECT * FROM categories",$db);

if (!$result2)
{
echo "<p>Запрос на выборку данных из базы не прошел. Напишите об этом администраторуtestblog.a-studia.in.ua. <br> <strong>Код ошибки:</strong></p>";
exit(mysql_error());
}

if (mysql_num_rows($result2) > 0)

{
$myrow2 = mysql_fetch_array($result2);


do 
{
printf ("<ul class='templatemo_list'><li><a href='view_cat.php?cat=%s'>%s</a></li></ul>",$myrow2["id"],$myrow2["title"]);



}
while ($myrow2 = mysql_fetch_array($result2));



 
}

else
{
echo "<p>Информация по запросу не может быть извлечена в таблице нет записей.</p>";

}


 ?>
 
 
<h4>Последние записи</h4>
 
 <?php 
 
$result3 = mysql_query("SELECT id,title FROM data WHERE activation=1 ORDER BY id DESC LIMIT 5",$db);

if (!$result3)
{
echo "<p>Запрос на выборку данных из базы не прошел. Напишите об этом администратору  <br> <strong>Код ошибки:</strong></p>";
exit(mysql_error());
}

if (mysql_num_rows($result3) > 0)

{
$myrow3 = mysql_fetch_array($result3);

do 
{
printf ("<ul class='templatemo_list'><li><a href='view_post.php?id=%s'>%s</a></li></ul>",$myrow3["id"],$myrow3["title"]);



}
while ($myrow3 = mysql_fetch_array($result3));


 
}

else
{
echo "<p>Информация по запросу не может быть извлечена в таблице нет записей.</p>";

}
 
 ?>

 
 <h4>Архив</h4>
<? 
 
 $result4 = mysql_query("SELECT DISTINCT left(date,7) AS month FROM data ORDER BY month DESC",$db);

if (!$result4)
{
echo "<p>Запрос на выборку данных из базы не прошел. Напишите об этом администратору  <br> <strong>Код ошибки:</strong></p>";
exit(mysql_error());
}

if (mysql_num_rows($result4) > 0)

{
$myrow4 = mysql_fetch_array($result4); 

do 
{
printf ("<ul class='templatemo_list'><li><a class='nav_link' href='view_date.php?date=%s'>%s</a></li></ul>",$myrow4["month"],$myrow4["month"]);



}
while ($myrow4 = mysql_fetch_array($result4));




}

else
{
echo "<p>Информация по запросу не может быть извлечена в таблице нет записей.</p>";

}

?> 




 <h4>Статистика</h4>
 
 <?php 
 
$result10 = mysql_query ("SELECT COUNT(*) FROM data",$db);
$sum = mysql_fetch_array($result10);

$result11 = mysql_query ("SELECT COUNT(*) FROM comments",$db);
$sum2 = mysql_fetch_array($result11);



echo "<p class='comments'>Записей в базе: $sum[0]<br> Коментариев: $sum2[0]<br> </p>";
 
 ?>
 
 
 
</div>
 </div> <!-- end of templatemo_left_column -->
