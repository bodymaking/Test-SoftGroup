<?php
include ("lock.php");
include ("blocks/bd.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Удалить неактивированную запись</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="templatemo_wrapper">
<? $n=1; include ("blocks/nav.php"); ?>

<? include ("blocks/lefttd.php"); ?>
       

 <div id="templatemo_right_column">
  <div id="templatemo_main">

                        <p><strong>Выберите запись для удаления        </strong></p>
                        <form action="drop_post_activation.php" method="post">
                            <?

                            $del_post = mysql_query("SELECT title,id FROM data WHERE activation=0");
                            $myrow = mysql_fetch_array($del_post);

                            do 
{
printf ("<p><input name='id' type='radio' value='%s'><label> %s</label></p>",$myrow["id"],$myrow["title"]);
}

                            while ($myrow = mysql_fetch_array($del_post));
                            ?>

                            <p> <input name="submit" type="submit" value="Удалить"></p>

                        </form>

 </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>
</body>
</html>
