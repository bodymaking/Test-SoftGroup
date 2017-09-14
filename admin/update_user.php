<?php
include ("lock.php");
include ("blocks/bd.php");
if (isset($_POST['activation']))      {$activation = $_POST['activation']; if ($activation == '') {unset($activation);}}
if (isset($_POST['id']))      {$id = $_POST['id'];}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Обновление пользователя</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="templatemo_wrapper">
<? $n=1; include ("blocks/nav.php"); ?>

<? include ("blocks/lefttd.php"); ?>
       

 <div id="templatemo_right_column">
  <div id="templatemo_main">

                        <?php
                        if ( isset($activation))
                        {
                            /* Здесь пишем что можно заносить информацию в базу */
                            $result = mysql_query ("UPDATE users SET email='$email', login='$login', activation='$activation' WHERE id='$id'");

                            if ($result == 'true') {echo "<p>Ваша заметка успешно обновлена!</p>";}
                            else {echo "<p>Ваша заметка не обновлена!</p>";}


                        }
                        else

                        {
                            echo "<p>Вы ввели не всю информацию, поэтому заметка в базе не может быть обновлена.</p>";
                        }



                        ?>


                     </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>
</body>
</html>
