<? include ("blocks/bd.php");
session_start();
$log = $_POST['log'];
$pass = $_POST['pass'];
$sql=mysql_query("SELECT * FROM `users` WHERE `active`='1'");
while($row=mysql_fetch_array($sql)){
$id=$row['id'];
$login=$row['login'];
$password=$row['password'];
$name=$row['name'];
}
if(isset($_POST['submit'])){
if(empty($log) or empty($pass)){
echo "<font color='red'><b>Пожалуйста заполните все поля!</b></font>";
}else{ 
if($log==$login AND $pass==$password){
$_SESSION['login']= $login;
$_SESSION['password']= $password;

if(isset($_SESSION['login']) AND isset($_SESSION['password'])){
echo "Привет".$name;
}
}
else{
echo"<font color='red'><b>Некорректный логин или пароль</b></font>";
 }
 }
}
?>