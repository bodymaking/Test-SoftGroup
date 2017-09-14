<?php session_start();// запускаем сесії обов'язково на початку страницы
include ("blocks/bd.php");
?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Сохранить пользователя</title>
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

if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } 
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
if (isset($_POST['password2'])) { $password2=$_POST['password2']; if ($password2 =='') { unset($password2);} }
if (isset($_POST['code'])) { $code = $_POST['code']; if ($code == '') { unset($code);} } 

if (isset($_POST['email'])) { $email = $_POST['email']; if ($email == '') { unset($email);} } 
if (isset($_POST['phone'])) { $phone = $_POST['phone']; if ($phone == '') { unset($phone);} } 

if ($_POST['password'] != $_POST['password2'])  
{
    exit("Пароли не совпадают");
}
if (empty($login) or empty($password)or empty($code) or empty($email) or empty($phone)) 
{
exit ("Вы ввели не всю информацию, пожалуйста заполните все поля!"); 
}
if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $email)) 
{exit ("Неправильный  е-mail!");}
if (!preg_match("#^[A-Za-z0-9]+$#", $login)) 
{exit ("Пожалуйста проверьте правильность логина");}

function generate_code() 
{

    $hours = date("H");     
    $minuts = substr(date("H"), 0 , 1);
    $mouns = date("m");    
    $year_day = date("z"); 

    $str = $hours . $minuts . $mouns . $year_day; 
    $str = md5(md5($str)); 
	$str = strrev($str);
	$str = substr($str, 3, 6); 
	
	

    $array_mix = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
    srand ((float)microtime()*1000000);
    shuffle ($array_mix);
	
    return implode("", $array_mix);
}

function chec_code($code) 
{
    $code = trim($code);

    $array_mix = preg_split ('//', generate_code(), -1, PREG_SPLIT_NO_EMPTY);
    $m_code = preg_split ('//', $code, -1, PREG_SPLIT_NO_EMPTY);

    $result = array_intersect ($array_mix, $m_code);
if (strlen(generate_code())!=strlen($code))
{
    return FALSE;
}
if (sizeof($result) == sizeof($array_mix))
{
    return TRUE;
}
else
{
    return FALSE;
}
}


if (!chec_code($_POST['code']))
{
exit ("Вы ввели неправильный код с картинки."); 
}



$login = stripslashes($login);
$login = htmlspecialchars($login);

$password = stripslashes($password);
$password = htmlspecialchars($password);

//удаляем лишние пробелы
$login = trim($login);
$password = trim($password);


// дописываем новое********************************************

//добавляем проверку на длину логина и пароля
if (strlen($login) < 3 or strlen($login) > 15) {

exit ("Логин должен быть не менее 3 символов и не больше 15."); 

}
if (strlen($password) < 3 or strlen($password) > 15) {

exit ("Пароль должен быть не менее 3 символов и не больше 15."); 
}

if (empty($_FILES['fupload']['name']))
{

$avatar = "avatars/net-avatara.jpg"; 
}

else 
{

$path_to_90_directory = 'avatars/';
	
if(preg_match('/[.](JPG)|(jpg)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['fupload']['name']))
	 {	
	 	 	
		$filename = $_FILES['fupload']['name'];
		$source = $_FILES['fupload']['tmp_name'];	
		$target = $path_to_90_directory . $filename;
		move_uploaded_file($source, $target);

	if(preg_match('/[.](GIF)|(gif)$/', $filename)) {
	$im = imagecreatefromgif($path_to_90_directory.$filename) ; 
	}
	if(preg_match('/[.](PNG)|(png)$/', $filename)) {
	$im = imagecreatefrompng($path_to_90_directory.$filename) ;
	}
	
	if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/', $filename)) {
		$im = imagecreatefromjpeg($path_to_90_directory.$filename); 
	}
	


$w = 90;  // квадратная 90x90. Можно поставить и другой размер.

// создаём исходное изображение на основе 
// исходного файла и определяем его размеры 
$w_src = imagesx($im); //вычисляем ширину
$h_src = imagesy($im); //вычисляем высоту изображения

         // создаём пустую квадратную картинку 
         // важно именно truecolor!, иначе будем иметь 8-битный результат 
         $dest = imagecreatetruecolor($w,$w); 

         // вырезаем квадратную серединку по x, если фото горизонтальное 
         if ($w_src>$h_src) 
         imagecopyresampled($dest, $im, 0, 0,
                          round((max($w_src,$h_src)-min($w_src,$h_src))/2),
                          0, $w, $w, min($w_src,$h_src), min($w_src,$h_src)); 

         // вырезаем квадратную верхушку по y, 
         // если фото вертикальное (хотя можно тоже серединку) 
         if ($w_src<$h_src) 
         imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w,
                          min($w_src,$h_src), min($w_src,$h_src)); 

         // квадратная картинка масштабируется без вырезок 
         if ($w_src==$h_src) 
         imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, $w_src, $w_src); 
		 

$date=time(); //вычисляем время в настоящий момент.
imagejpeg($dest, $path_to_90_directory.$date.".jpg");//сохраняем изображение формата jpg в нужную папку, именем будет текущее время. Сделано, чтобы у аватаров не было одинаковых имен.

//почему именно jpg? Он занимает очень мало места + уничтожается анимирование gif изображения, которое отвлекает пользователя. Не очень приятно читать его комментарий, когда краем глаза замечаешь какое-то движение.

$avatar = $path_to_90_directory.$date.".jpg";//заносим в переменную путь до аватара.

$delfull = $path_to_90_directory.$filename; 
unlink ($delfull);//удаляем оригинал загруженного изображения, он нам больше не нужен. Задачей было - получить миниатюру.
}
else 
         {
		 //в случае несоответствия формата, выдаем соответствующее сообщение
         
exit ("Аватар должен быть в форматк <strong>JPG,GIF или PNG</strong>"); //останавливаем выполнение сценариев

	     }
//конец процесса загрузки и присвоения переменной $avatar адреса загруженной авы
}

$password = md5($password);//шифруем пароль

$password = strrev($password);// для надежности добавим реверс

$password = $password."b3p6f";
//можно добавить несколько своих символов по вкусу, например, вписав "b3p6f". Если этот пароль будут взламывать метадом подбора у себя на сервере этой же md5,то явно ничего хорошего не выйдет. Но советую ставить другие символы, можно в начале строки или в середине.

//При этом необходимо увеличить длину поля password в базе. Зашифрованный пароль может получится гораздо большего размера.


// дописали новое********************************************

// Далее идет все из первой части статьи,но необходимо дописать изменение в запрос к базе. 

// подключаемся к базе

// проверка на существование пользователя с таким же логином
$result = mysql_query("SELECT id FROM users WHERE login='$login'",$db);
$myrow = mysql_fetch_array($result);
if (!empty($myrow['id'])) {

exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин."); //останавливаем выполнение сценариев

}

// если такого нет, то сохраняем данные
$result2 = mysql_query ("INSERT INTO users (login,password,avatar,email,date,phone) VALUES('$login','$password','$avatar','$email',NOW(),'$phone')");
// Проверяем, есть ли ошибки
if ($result2=='TRUE')
{

$result3 = mysql_query ("SELECT id FROM users WHERE login='$login'",$db);//извлекаем идентификатор пользователя. Благодаря ему у нас и будет уникальный код активации, ведь двух одинаковых идентификаторов быть не может.
$myrow3 = mysql_fetch_array($result3);
$activation = md5($myrow3['id']).md5($login);//код активации аккаунта. Зашифруем через функцию md5 идентификатор и логин. Такое сочетание пользователь вряд ли сможет подобрать вручную через адресную строку.

$subject = "Подтверждение регистрации";//тема сообщения
$message = "Здравствуйте! Спасибо за регистрацию на http://testblog.a-studia.in.ua\nВаш логин: ".$login."\n
Перейдите по ссылке, чтобы активировать ваш аккаунт:\nhttp://testblog.a-studia.in.ua/activation.php?login=".$login."&code=".$activation."\nС уважением,\n
Администрация testblog.a-studia.in.ua/";//содержание сообщение
mail($email, $subject, $message, "Content-type:text/plane; Charset=utf-8\r\n");//отправляем сообщение
	
echo "<p class='margin_text'> Вам на E-mail отправлено письмо с подтверждением регистрации. Внимание! Ссылка действительна 1 час. <a href='index.php'>Главная страница</a></p>"; //говорим о отправленном письме пользователю
}
else {
exit ("Ошибка! Вы не зарегистрированы."); //останавливаем выполнение сценариев

     }
?>

     </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>
</body>
</html>
