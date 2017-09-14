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
if (isset($_POST['date']))        {$date = $_POST['date']; if ($date == '') {unset($date);}}
if (isset($_POST['description'])) {$description = $_POST['description']; if ($description == '') {unset($description);}}
if (isset($_POST['text']))        {$text = $_POST['text']; if ($text == '') {unset($text);}}
if (isset($_POST['author']))      {$author = $_POST['author']; if ($author == '') {unset($author);}}
if (isset($_POST['id']))      {$id = $_POST['id'];}

if (isset($_POST['cat']))      {$cat = $_POST['cat']; if ($cat == '') {unset($cat);}}

if (isset($_POST['activation']))      {$activation = $_POST['activation']; if ($activation == '') {unset($activation);}}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Обновление неактивированной записи</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="templatemo_wrapper">
<? $n=1; include ("blocks/nav.php"); ?>

<? include ("blocks/lefttd.php"); ?>
       

 <div id="templatemo_right_column">
  <div id="templatemo_main">

                        <?php
                        if (isset($title) && isset($meta_d) && isset($meta_k) && isset($date) && isset($description) && isset($text) && isset($author) && isset($cat))
                        {
                            /* Здесь пишем что можно заносить информацию в базу */
                            $result = mysql_query ("UPDATE data SET title='$title', meta_d='$meta_d', meta_k='$meta_k', date='$date', description='$description', text='$text', author='$author', cat='$cat', activation='$activation' WHERE id='$id'");

                            if ($result == 'true') {echo "<p>Ваша запись успешно обновлена</p>";}
                            else {echo "<p>Ваша запись не обновлена</p>";}


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
