<? // WR-guest v 1.7M //  07.01.07 г.  //  Miha-ingener@yandex.ru

#error_reporting (E_ALL);

include ("admin/lock.php");

include "config.php";

$password = 1;

// Блок ВИДАЛЕННЯ вибраного повідомлення
if (isset($_GET['id'])) { $page=$_GET['page'];
$file=file("guest.dat"); $itogo=count($file)-1;
if ($msginout==1) {$id=$itogo-$_GET['id'];} else {$id=$itogo-$_GET['id']+2;}
if ($itogo<1) {print"$back. Потрібно залишити хоча б одне повідомлення!"; exit;}

$fp=fopen("guest.dat","w");
flock ($fp,LOCK_EX);
for ($i=0;$i< sizeof($file);$i++) { if ($i==$id) {unset($file[$i]);} }
fputs($fp, implode("",$file));
flock ($fp,LOCK_UN);
fclose($fp);
@chmod("guest.dat", 0644);
Header("Location: admin.php?pswrd=$password&page=$page"); exit; }



if (isset($_GET['event'])) {

if ($_GET['event']=="add") { // if ($event =="add")

$name=$_POST['name']; $msg=$_POST['msg']; $email=$_POST['email']; 
if (isset($_POST['page'])) {$page=$_POST['page'];} else {$page=1;}

if ($name=="" || strlen($name) > $maxname) {print "$back ви не ввели ім'я, або вввелі занадто довге ім'я!</B></center>"; exit;}
if ($msg=="" || strlen($msg) > $maxmsg) {print "$back ваше повідомлення або пусте або перевищує $ maxmsg символів.</B></center>"; exit;}

// обрізаємо зайві символи в Емайл і повідомленні
$email=substr($email,0,30);
$msg=stripslashes($msg);
$msg=htmlspecialchars($msg);
$msg=str_replace("|","I",$msg);
$msg=str_replace("\r\n","<br>",$msg);


// якщо вибрано - редагування
if (isset($_GET['rd'])) { $rd=$_GET['rd'];
$fdate=$_POST['fdate'];$ftime=$_POST['ftime']; //$rd - номер РЕДАГОВАНОЇ комірки
$text="$msg|$name|$email|$fdate|$ftime|";
$file=file("guest.dat");
$fp=fopen("guest.dat","a+");
flock ($fp,LOCK_EX);
ftruncate ($fp,0);//ВИДАЛЯЄМО ЗМІСТ ФАЙЛУ
for ($i=0;$i< sizeof($file);$i++) {if ($rd!=$i) {fputs($fp,$file[$i]);} else {fputs($fp,"$text\r\n");}}
fflush ($fp);//очищення файлового буферу
flock ($fp,LOCK_UN);
fclose($fp);
@chmod("guest.dat", 0644);
}


else {
$text="$msg|$name|$email|$date|$time|";
$fp=fopen("guest.dat","a+");
flock ($fp,LOCK_EX);
fputs($fp,"$text\r\n");
fflush ($fp);//очищення файлового буферу
flock ($fp,LOCK_UN);
fclose($fp);
@chmod("guest.dat", 0644);
}

Header("Location: admin.php?pswrd=$password&page=$page"); exit; }





if ($_GET['event']=="skin")  {

if ($sendmail=="1") {$s1="checked"; $s2="";} else {$s2="checked"; $s1="";}
if ($antiflud=="1") {$af1="checked"; $af2="";} else {$af2="checked"; $af1="";}
if ($liteurl=="1") {$lu1="checked"; $lu2="";} else {$lu2="checked"; $lu1="";}

print "<html><head><META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\"><META HTTP-EQUIV=\"Cache-Control\" CONTENT=\"no-cache\"><META content='text/html; charset=utf-8' http-equiv=Content-Type><link rel=stylesheet type='text/css' href='images/$skin/style.css'></head><body><BR><BR><BR><center>

<TABLE width=780 align=center cellPadding=0 cellSpacing=0><TBODY>
<TR><TD width='1%'><IMG src='images/$skin/1.gif' width=14 height=12 border=0></TD><TD width='96%' background='images/$skin/2.gif'></TD><TD width='3%'><IMG src='images/$skin/3.gif' width=14 height=12 border=0></TD></TR>
<TR><TD background='images/$skin/4.gif'></TD>
<TD><table width=100%><TR>
<TD><B>Сьогодні <b>$date</b></TD>
<TD align=center><B><a href=admin.php?pswrd=$password&event=skin>Конфігурування</a></TD>
<TD align=center><B><a href='admin.php?pswrd=$password'>Главная адмінки</a></div></B>
<TD align=center><B><a href='admin.php?event=clearcooke'>Повернутися на головну</a></div></B>
</TD></TR>
<TR><TD colspan=4><hr size=-1 width=100%></TD></TR></TABLE>

<table width=100%><TR><TD>
<center><B><font size=+1>Конфігурування</font></b>
<form action=admin.php?pswrd=$password&event=config method=POST name=REPLIER>
<table>
<tr><td>Ім'я користувача</td><td><input type=text value='$gname' name=gname size=50></tr></td>
<tr><td>Текст вітання</td><td><textarea cols=50 rows=4 size=500 name=maintext>$maintext</textarea></tr></td>
<tr><td>Емейл адміна / відсилати повідомлення</td><td><input type=text value='$adminemail' name=adminemail size=30>&nbsp;&nbsp;&nbsp;&nbsp; <input type=radio name=sendmail value=\"1\"$s1/> да&nbsp;&nbsp; <input type=radio name=sendmail value=\"0\"$s2/> нет</tr></td></tr></td>

<tr><td>Задіяти функцію <B> антиспам </ B>?</td><td><select class=input name=antispam>
<option value=\"$antispam\">Не змінювати</option>
<option value='0'>Ні , відключити</option>
<option value='1'>Так - Цифротекст</option>
<option value='2'>Так - Матоперації</option>
<option value='3'>Так - Загадки</option>
<option value='4'>Так - Цифрозахист</option>
</select></tr></td>

<tr><td class=row1>Задіяти функцію <B>АНТИФЛУД</B>?</td><td class=row1><input type=radio name=antiflud value=\"1\"$af1/> да&nbsp;&nbsp; <input type=radio name=antiflud value=\"0\"$af2/> ні/tr></td>
<tr><td class=row1>Зробити посилання в тексті <B>активними</B>?</td><td class=row1><input type=radio name=liteurl value=\"1\"$lu1/> так&nbsp;&nbsp; <input type=radio name=liteurl value=\"0\"$lu2/> ні</tr></td>

<tr><td>Макс. довжина імені</td><td><input type=text value='$maxname' name=maxname size=10></tr></td>
<tr><td>Макс. довжина повідомлення</td><td><input type=text value='$maxmsg' name=maxmsg size=10></tr></td>
<tr><td>Повідомленнь на сторінку</td><td><input type=text value='$qq' name=qq size=10></tr></td>
<tr><td>Проходження повідомлень</td><td><select class=input name=msginout><option value='$msginout'>Теперішнє</option><option value='1'>за спаданням</option><option value='0'>за зростанням</option></select></tr></td>

<tr><td>Скін</td><td><select class=input name=skin>

<option value=\"$skin\">Теперішній</option>
<option value='original' style='color: #000000; background: #FF0000'>Світло-червоний</option>
<option value='black' style='color: #000000; background: #FFFFFF'>Чорно-білий</option>
<option value='blue' style='color: #FFFFFF; background: #0086BF'>Темно-блакитний</option>
<option value='korich' style='color: #FFFFFF; background: #968549'>Коричневий</option>

</select></nobr></tr></td>

<tr><td colspan=2><center><table><tr><td><input type=submit value='Сохранить конфігурацію'></form></td></tr></table>
</td></tr></table>

</TD></TR></TABLE></TD>
<TD background='images/$skin/6.gif'>&nbsp;</TD>
</TR><TR><TD><IMG src='images/$skin/8.gif' width=14 height=12 border=0></TD><TD background='images/$skin/5.gif'></TD><TD><IMG src='images/$skin/9.gif' width=14 height=12 border=0></TD></TR>
</TBODY></TABLE>
";
exit;
}



if ($_GET['event']=="config")  {

$configdata="<? // WR-guest v 1.7M //  07.01.07 г.  //  Miha-ingener@yandex.ru\r\n".
"$"."gname=\"".$_POST['gname']."\"; // Имя гостевой книги отображается в теге TITLE и заголовке\r\n".
"$"."maintext=\"".$_POST['maintext']."\"; // Текст, выводящийся перед формой ввода сообщения\r\n".
"$"."adminemail=\"".$_POST['adminemail']."\"; // Емайл админа\r\n".
"$"."sendmail=\"".$_POST['sendmail']."\"; // отсылать сообщения на Емайл админу\r\n"."$"."antispam=\"".$_POST['antispam']."\"; // АНТИСПАМ вкл1/вкл2/вкл3/вкл4/выкл - 1/2/3/4/0\r\n".
"$"."antiflud=\"".$_POST['antiflud']."\"; // Функцию АНТИФЛУД вкл/выкл: 1/0\r\n".
"$"."maxname=\"".$_POST['maxname']."\";  // Максимальное кол-во символов в имени\r\n".
"$"."maxmsg=\"".$_POST['maxmsg']."\"; // Максимальное кол-во символов в сообщении\r\n".
"$"."msginout=\"".$_POST['msginout']."\"; // порядок просмотра сообщений: возрастание/убывание - 1/0\r\n".
"$"."qq=\"".$_POST['qq']."\"; // кол-во отображаемых сообщений на каждой странице гостевой: 1-100\r\n".
"$"."skin=\"".$_POST['skin']."\";  // Скин\r\n".
"$"."liteurl=\"".$_POST['liteurl']."\";// Подсвечивать УРЛ? 1/0\r\n".
"$"."back=\"<center>Вернитесь <a href='javascript:history.back(1)'><B>назад</B></a>\"; // Удобная строка\r\n".
"$"."s2=\"<img src='images/biggrin.gif' border=0>\";  // Смайлики ;-)\r\n".
"$"."s1=\"<img src='images/smile.gif' border=0>\";\r\n".
"$"."s3=\"<img src='images/razz.gif' border=0>\";\r\n".
"$"."s4=\"<img src='images/cool.gif' border=0>\";\r\n".
"$"."s5=\"<img src='images/mad.gif' border=0>\";\r\n".
"$"."s6=\"<img src='images/redface.gif' border=0>\";\r\n".
"$"."s7=\"<img src='images/wink.gif' border=0>\";\r\n".
"$"."s8=\"<img src='images/rolleyes.gif' border=0>\";\r\n".
"$"."s9=\"<img src='images/confused.gif' border=0>\";\r\n".
"$"."s10=\"<img src='images/eek.gif' border=0>\";\r\n".
"$"."s11=\"<img src='images/cry.gif' border=0>\";\r\n".
"$"."s12=\"<font color=#ff0000><B>\";\r\n".
"$"."date=date(\"d.m.Y\"); // число.месяц.год\r\n".
"$"."time=date(\"H:i:s\"); // часы:минуты:секунды \r\n?>";

$file=file("config.php");
$fp=fopen("config.php","a+");
flock ($fp,LOCK_EX);
ftruncate ($fp,0);//УДАЛЯЕМ СОДЕРЖИМОЕ ФАЙЛА
fputs($fp,$configdata);
fflush ($fp);//очищение файлового буфера
flock ($fp,LOCK_UN);
fclose($fp);
@chmod("config.php", 0644);
Header("Location: admin.php?pswrd=$password&event=skin"); exit; }

} // if isset['event']


else {

if (isset($_GET['page'])) {$page=$_GET['page'];} else {$page="1";}

print "<html><head>
<title>$gname</title>
<META HTTP-EQUIV='Pragma' CONTENT='no-cache'>
<META HTTP-EQUIV='Cache-Control' CONTENT='no-cache'>
<META content='text/html; charset=utf-8' http-equiv=Content-Type>
<link rel=stylesheet type='text/css' href='images/$skin/style.css'>
<SCRIPT language=JavaScript>
function x () {return;}
function FocusText() {
    document.REPLIER.msg.focus();
    document.REPLIER.msg.select();
    return true; }
function DoSmilie(addSmilie) {
    var revisedmsgage;
    var currentmsgage = document.REPLIER.msg.value;
    revisedmsgage = currentmsgage+addSmilie;
    document.REPLIER.msg.value=revisedmsgage;
    document.REPLIER.msg.focus();
    return;
}
function DoPrompt(action) { var revisedmsgage; var currentmsgage = document.REPLIER.qmsgage.value; }
</SCRIPT>
</head>
<body>
<center><a href=index.php><h3>$gname</h3></a>

<TABLE width=780 align=center cellPadding=0 cellSpacing=0><TBODY>
<TR><TD width='1%'><IMG src='images/$skin/1.gif' width=14 height=12 border=0></TD><TD width='96%' background='images/$skin/2.gif'></TD><TD width='3%'><IMG src='images/$skin/3.gif' width=14 height=12 border=0></TD></TR>
<TR><TD background='images/$skin/4.gif'></TD>
<TD>
<table width=100%><TR>
<TD><B>Сегодня <b>$date</b></TD>
<TD align=center><B><a href=admin.php?pswrd=$password&event=skin>Конфігурування</a></TD>
<TD align=center><B><a href='admin.php?pswrd=$password'>Главная адмінки</a></div></B>
<TD align=center><B><a href='admin.php?event=clearcooke'>Повернутися на головну</a></div></B>
</TD></TR></TABLE>
</TD>
<TD background='images/$skin/6.gif'>&nbsp;</TD>
</TR><TR><TD><IMG src='images/$skin/8.gif' width=14 height=12 border=0></TD><TD background='images/$skin/5.gif'></TD><TD><IMG src='images/$skin/9.gif' width=14 height=12 border=0></TD></TR>
</TBODY></TABLE>";



if ((!isset($_GET['event'])) or (isset($_GET['event'])) & ($_GET['event']!="add"))  {
$lines=file("guest.dat");
$itogo=count($lines);
$maxi=$itogo-1;
print "
<TABLE width=780 align=center cellPadding=0 cellSpacing=0><TBODY>
<TR><TD width='1%'><IMG src='images/$skin/1.gif' width=14 height=12 border=0></TD><TD width='96%' background='images/$skin/2.gif'></TD><TD width='3%'><IMG src='images/$skin/3.gif' width=14 height=12 border=0></TD></TR>
<TR><TD background='images/$skin/4.gif'></TD>
<TD><center><b><font size=+1>Всього повідомленнь в базі: <font color=#FF0000>$itogo</font>, добав ще!</font></b></center>
<center><table ><tr><td valign=top>
<B>Ім'я</B> и E-mail<BR>
<B>Повідомлення</B>
<table width=90 height=70><tr><td valign=top>
<A href='javascript:%20x()' onclick=\"DoSmilie(' :-))');\">$s1</a>
<a href='javascript:%20x()' onclick=\"DoSmilie(' :-)');\">$s2</a>
<a href='javascript:%20x()' onclick=\"DoSmilie(' :-P');\">$s3</a>
<a href='javascript:%20x()' onclick=\"DoSmilie(' 8-)');\">$s4</a>
<a href='javascript:%20x()' onclick=\"DoSmilie(' :-(');\">$s5</a>
<A href='javascript:%20x()' onclick=\"DoSmilie(' :-O');\">$s6</a>
<A href='javascript:%20x()' onclick=\"DoSmilie(' ;-)');\">$s7</a>
<A href='javascript:%20x()' onclick=\"DoSmilie(':roll:');\">$s8</a>
<A href='javascript:%20x()' onclick=\"DoSmilie(':rf:');\">$s9</a>
<A href='javascript:%20x()' onclick=\"DoSmilie(' 8-(');\">$s10</a>
<A href='javascript:%20x()' onclick=\"DoSmilie(' `-(');\">$s11</a>
<A href='javascript:%20x()' onclick=\"DoSmilie('[RB] [/RB]');\"><font color=red><B>RB</b></font></a>
</tr></td></table>
</td><td>
";  


// ищем сообщение для редактирования и выводим его в форму
if (isset($_GET['rd']))  {
if ($msginout==1) {$rd=$maxi-$_GET['rd'];} else {$rd=$maxi-$_GET['rd']+2;}

$dt=explode("|",$lines[$rd]);
$dt[0]=str_replace("<br>", "\r\n", $dt[0]);

print "
<form action=admin.php?pswrd=$password&event=add&rd=$rd method=POST name=REPLIER>
<input type=text value='$dt[1]' name=name size=30>&nbsp;
<input type=text value='$dt[2]' name=email size=26><br> 
<textarea cols=59 rows=10 size=500 name=msg>$dt[0]</textarea>
<input type=hidden name=fdate value='$dt[3]'> 
<input type=hidden name=ftime value='$dt[4]'>
<input type=hidden name=page value='$page'>
<SCRIPT language=JavaScript>document.REPLIER.msg.focus();</SCRIPT>
<center><input type=submit value='Сохранить під цим же номером'></form>
";
}
else 
{
print "<form action=admin.php?pswrd=$password&event=add method=post name=REPLIER>
<input type=text value='' name=name size=30>&nbsp;
<input type=text value='' name=email size=26><br> 
<textarea cols=59 rows=10 size=500 name=msg></textarea>
<SCRIPT language=JavaScript>document.REPLIER.msg.focus();</SCRIPT>
<center><input type=submit value='Додати'></form>";
}
print"</tr></td></table>

</TD><TD background='images/$skin/6.gif'>&nbsp;</TD>
</TR><TR><TD><IMG src='images/$skin/8.gif' width=14 height=12 border=0></TD><TD background='images/$skin/5.gif'></TD><TD><IMG src='images/$skin/9.gif' width=14 height=12 border=0></TD></TR>
</TBODY></TABLE>";



// Выводим qq сообщений на текущей странице

if ($page=="0") {$page="1";} else {$page=abs($page);}

$maxpage=ceil(($maxi+1)/$qq); if ($page>$maxpage) {$page=$maxpage;}

if ($msginout=="1") 
{ $fm=$qq*($page-1); if ($fm>$maxi) {$fm=$maxi-$qq;}
  $lm=$fm+$qq; if ($lm>$maxi) {$lm=$maxi+1;} }
else 
{ $fm=$maxi-$qq*($page-1); if ($fm<"0") {$fm=$qq;}
  $lm=$fm-$qq; if ($lm<"0") {$lm="-1";} }


do { $dt = explode("|", $lines[$fm]);
if ($msginout=="1") {$fm++;} else {$fm--;}
$num=$itogo-$fm; $pnum=$num-1;
// заменяем текстовые смайлики на графические
$dt[0]=str_replace(":-))",$s1,$dt[0]);
$dt[0]=str_replace(":-)",$s2,$dt[0]);
$dt[0]=str_replace(":-P",$s3,$dt[0]);
$dt[0]=str_replace("8-)",$s4,$dt[0]);
$dt[0]=str_replace(":-(",$s5,$dt[0]);
$dt[0]=str_replace(":-O",$s6,$dt[0]);
$dt[0]=str_replace(";-)",$s7,$dt[0]);
$dt[0]=str_replace(":roll:",$s8,$dt[0]);
$dt[0]=str_replace(":rf:",$s9,$dt[0]);
$dt[0]=str_replace("8-(",$s10,$dt[0]);
$dt[0]=str_replace("`-(",$s11,$dt[0]);
$dt[0]=str_replace("[RB]","<B><font color=red>", $dt[0]);
$dt[0]=str_replace("[/RB]","</font></B>", $dt[0]);
$dt[0]=str_replace("&amp;#124;","&#124;",$dt[0]);
$dt[0]=eregi_replace("((https?|ftp)://[[:alnum:]_=/-]+(\\.[[:alnum:]_=/-]+)*(/[[:alnum:]+&._=/~%]*(\\?[[:alnum:]?+&;_=/%]*)?)?)", "<a href='\\1' target='_blank'>\\1</a>", $dt[0]);


print"
<TABLE width=780 align=center cellPadding=0 cellSpacing=0><TBODY>
<TR><TD width='1%'><IMG src='images/$skin/1.gif' width=14 height=12 border=0></TD><TD width='96%' background='images/$skin/2.gif'></TD><TD width='3%'><IMG src='images/$skin/3.gif' width=14 height=12 border=0></TD></TR>
<TR><TD background='images/$skin/4.gif'></TD>
<TD><B><a href='mailto:$dt[2]'>$dt[1]</a> ($dt[3] $dt[4])</B><BR>
<em>$dt[0]</em><BR>
<div align=right>

<table><TR><TD bgcolor=#22FF44>
<B><a href='admin.php?pswrd=$password&rd=$num&page=$page'>.P.</a></TD><TD>&nbsp;&nbsp;</TD><TD bgcolor=#FF2244><a href='admin.php?pswrd=$password&id=$num&page=$page'>.X.</a></B></TD><TD> &nbsp;&nbsp; $pnum
</TD></TR></TABLE>
</div>
</TD>
<TD background='images/$skin/6.gif'>&nbsp;</TD>
</TR><TR><TD><IMG src='images/$skin/8.gif' width=14 height=12 border=0></TD><TD background='images/$skin/5.gif'></TD><TD><IMG src='images/$skin/9.gif' width=14 height=12 border=0></TD></TR>
</TBODY></TABLE>
";



if ($msginout=="1") {$whm=$fm; $whe=$lm;} else {$whm=$lm; $whe=$fm;}
} while($whm < $whe);
print "</td></tr></table>";


// выводим СПИСОК доступных номеров СТРАНИЦ ВНИЗУ
print "Страницы:&nbsp; ";
for($i=0; $i<$maxi+1;) {$ip=$i/$qq+1;
if ($page==$ip) {print "<B>$ip</B> &nbsp;";} else {print "<a href='admin.php?pswrd=$password&page=$ip'>$ip</a> &nbsp;";}
$i=$i+$qq;} print "(дробление = <B>$qq</B>)";
}

}



print "<BR><BR><center><font size=-2>Powered by <a href='http://www.wr-script.ru/'>WR-Guest</a> &copy; 1.7</font></body></html>";
?>
