<?php
session_start();
include ("blocks/bd.php");
{
    $title = $_POST['title'];

    if ($title == '')
    {
        unset($title);
    }

}


/* Перевірка  */
if (isset($_POST['meta_d']))      {$meta_d = $_POST['meta_d']; if ($meta_d == '') {unset($meta_d);}}
if (isset($_POST['meta_k']))      {$meta_k = $_POST['meta_k']; if ($meta_k == '') {unset($meta_k);}}
if (isset($_POST['date']))        {$date = $_POST['date']; if ($date == '') {unset($date);}}
if (isset($_POST['description'])) {$description = $_POST['description']; if ($description == '') {unset($description);}}
if (isset($_POST['author']))      {$author = $_POST['author']; if ($author == '') {unset($author);}}
if (isset($_POST['cat']))      {$cat = $_POST['cat']; if ($cat == '') {unset($cat);}}
if (isset($_POST['file']))      {$file = $_POST['file']; if ($file == '') {unset($file);}}
if (isset($_POST['text']))      {$text = $_POST['text']; if ($text == '') {unset($text);}}
if (isset($_POST['email']))      {$email = $_POST['email']; if ($email == '') {unset($email);}}
if (isset($_POST['login']))      {$login = $_POST['login']; if ($login == '') {unset($login);}}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Добавить запись</title>
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
                        <?php

                        if (isset($title) && isset($meta_d) && isset($meta_k) && isset($date) && isset($description)  && isset($author)  && isset($cat) && isset($text)   )
                        {
                            
                            $uploaddir = './files/';
                            $uploadfile = $uploaddir.basename($_FILES['file']['name']);


                            if (copy($_FILES['file']['tmp_name'], $uploadfile))
                            {
                                echo "<h3>Файл успешно загружен на сервер</h3>";
                            }
                            else { echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>"; exit; }
                            $id = $_SESSION['id'];
                            $file = $_FILES['file']['name'];
                            $result = mysql_query ("INSERT INTO data (title,meta_d,meta_k,date,description,author,cat,file,text,id_login) VALUES ('$title', '$meta_d','$meta_k','$date','$description','$author','$cat','$file','$text','$id') ");
                
                            if ($result == 'true') {echo "<p>Ваша запись добавлена!</p>";}
                            else {echo "<p>Ваша запись не добавлена</p>";}


                        }
                        else

                        {
                            echo "<p>Вы ввели не всю информацию, запись не может быть добавлена в базу данных.</p>";
                        }



                        ?>


             </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>

</body>
</html>
