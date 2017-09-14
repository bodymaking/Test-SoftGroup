<?php
include ("lock.php");
include ("blocks/bd.php");
if (isset($_POST['id'])) {$id = $_POST['id'];}
?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Удалить пользователя</title>
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

                                $id_user = mysql_query ("SELECT id FROM data WHERE id_login='$id'",$db);
                                if (mysql_num_rows($id_user) > 0) {

                                    echo "<p>В категории, которую Вы хотите удалить, есть заметки. Сначала перекиньте их по другим категориям.</p>";

                                }

                                else

                                {
                                    $result = mysql_query ("DELETE FROM users WHERE id='$id'");

                                    if ($result == 'true') {echo "<p>Користувач видалений</p>";}
                                    else {echo "<p>Ваша категория не удалена!</p>";}

                                }
                            }
                            else

                            {
                                echo "<p>Вы запустили данный фаил без параметра id и поэтому, удалить категорию невозможно (скорее всего Вы не выбрали радиокнопку на предыдущем шаге).</p>";
                            }



                            ?>


                    </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>
    </body>
    </html>
<?php
/**
 * Created by PhpStorm.
 * User: Parazit
 * Date: 15.06.2015
 * Time: 3:01
 */ 