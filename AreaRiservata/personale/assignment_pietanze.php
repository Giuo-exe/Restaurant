<?php
session_start();


echo "ciao ";

if(isset($_GET["cuoco"])){
  echo $_GET["cuoco"];
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <a href="assignment_handler.php">Torna indietro</a>
  </body>
</html>
