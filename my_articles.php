<?php
session_start();
include ("blocks/bd.php");
if (isset($_GET['id'])) {$id = $_GET['id'];}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Мои записи</title>
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
                    echo "<h3 align='center'>Мои записи</h3>";

                        if (!isset($id))

                        {   $id = $_SESSION['id'];
                            $login2 = mysql_query ("SELECT login FROM users WHERE id='$id'");
                            $login=mysql_fetch_array($login2);
                            $log=$login['login'];
                            $result = mysql_query("SELECT * FROM data WHERE id_login='$id'");}

                    if (mysql_num_rows($result) > 0)

                    {
                        $myrow = mysql_fetch_array($result);


                            do {
                                
                                printf('
					 <div class="post_section">
                        <h2 class="title-last-post"><a href="view_post.php?id=%s">%s</a></h2>
            %s| <strong>Автор:</strong> %s | <strong>Просмотры:</strong> %s
             <img src="files/%s"/>
                        <p class="description-last-post">%s</p>
                        
              <a href="view_post.php?id=%s">Подробнее</a>
              
                            </div>

                ',$myrow["id"],$myrow["title"],$myrow["date"],$myrow["author"],$myrow["view"],$myrow["file"],$myrow["description"],$myrow["id"]);
                

                            }
                            while ($myrow = mysql_fetch_array($result));

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
