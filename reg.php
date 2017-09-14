<? include ("blocks/bd.php");

$result = mysql_query("SELECT title,meta_d,meta_k,text FROM settings WHERE page='reg'",$db);

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
<title>Регистрация</title>
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
<div align="center"> <h2>Регистрация</h2>
<form action="save_user.php" method="post" enctype="multipart/form-data">

  <p>
    <label>Ваш логин *:<br></label>
    <input name="login" type="text" size="15" maxlength="15">
  </p>
  <p>
    <label>Ваш пароль *:<br></label>
    <input name="password" type="password" size="15" maxlength="15">
  </p>
    <p>
        <label>Подтверждение пароля *:<br></label>
        <input name="password2" type="password" size="15" maxlength="15">
    </p>

  <p>
    <label>Ваш E-mail *:<br></label>
    <input name="email" type="text" size="15" maxlength="100">
  </p>

  <p>
    <label>Ваш телефон *:<br></label>
    <input name="phone" type="text" size="11" maxlength="11">
  </p>

  
  <p>
    <label>Выберите ваш аватар.Изображение должно быть формата jpg, gif или png:<br></label>
    <input type="FILE" name="fupload">
  </p>

<p>Введите код з картинки *:<br>

<p><img src="code/my_codegen.php"></p>
<p><input type="text" name="code"></p>


<p>
<input type="submit" name="submit" value="Зарегистрироваться">

</p></form>
Звездочками (*) обозначены поля, обязательны для заполнения.
</div>
                    </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>
</body>
</html>
