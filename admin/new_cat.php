<? include ("lock.php");  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Новая категория</title>
<link href="style.css" rel="stylesheet" type="text/css">
 <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>

<body>
<div id="templatemo_wrapper">
<? $n=1; include ("blocks/nav.php"); ?>

<? include ("blocks/lefttd.php"); ?>
       

 <div id="templatemo_right_column">
  <div id="templatemo_main">
       <form name="form1" method="post" action="add_cat.php">
         <p>
           <label>Введите название категории<br>
             <input type="text" name="title" id="title">
             </label>
         </p>
         <p>
           <label>Введите краткое описание категории<br>
           <input type="text" name="meta_d" id="meta_d">
           </label>
         </p>
         <p>
           <label>Введите ключевые слова категории<br>
           <input type="text" name="meta_k" id="meta_k">
           </label>
         </p>
         
         <p>
           <label>Введите полный текст категории с тегами абзацов
           <textarea name="text" id="text" cols="40" rows="20"></textarea>
           </label>
         </p>
     
        
         
         
         <p>
           <label>
           <input type="submit" name="submit" id="submit" value="Добавить категорию в базу">
           </label>
         </p>
       </form>
       <p>&nbsp;</p>        </td>
       </div>
      </div>
        <? include ("blocks/footer.php"); ?>
      </div>
</body>
</html>
