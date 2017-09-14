<?php
include ("lock.php");
include ("blocks/bd.php");
if (isset($_GET['id'])) {$id = $_GET['id'];}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Все пользователи</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="templatemo_wrapper">
<? $n=1; include ("blocks/nav.php"); ?>

<? include ("blocks/lefttd.php"); ?>
       

 <div id="templatemo_right_column">
  <div id="templatemo_main">
                        <? echo $myrow["text"]; ?>
                        <div class="margin">



                            <?php
                            if (!isset($id))
                            {
                           
                            $result = mysql_query("SELECT login,id FROM users ORDER BY login ",$db); 
                            $myrow = mysql_fetch_array($result);
                            do
                            {

                                printf("<a href='all_users.php?id=%s'>%s</a><br>",$myrow['id'],$myrow['login']);
                            }
                            while($myrow = mysql_fetch_array($result));

                            }

                            else

                            {

                                $result = mysql_query("SELECT * FROM users WHERE id=$id");
                                $myrow = mysql_fetch_array($result);

                             echo "<h3 align='center'>Редактирование пользователя</h3>";

                                echo "<form name='form1' method='post' action='update_user.php'>";


                                print <<<HERE

         <p>
           <label>Логин<br>
             <input value="$myrow[login]" type="text" name="login" id="login">
             </label>
         </p>
         <p>
           <label>Email<br>
           <input value="$myrow[email]" type="text" name="email" id="email">
           </label>
         </p>
          <p>
           <label>Телефон<br>
             <input value="$myrow[phone]" type="text" name="phone" id="phone">
             </label>
         </p>
            <label for="Activation">Активация</label><br>
            <input id="activation" type="radio" name="activation" value="0" checked>0<Br>
            <input id="activation" type="radio" name="activation" value="1">1<Br>
            </p>

		 <input name="id" type="hidden" value="$myrow[id]">

         <p>
           <label>
           <input type="submit" name="submit" id="submit" value="Сохранить">
           </label>
         </p>
       </form>



HERE;
                            }



                            ?>
                        </div>
                     </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>
</body>
</html>
