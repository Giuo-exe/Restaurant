<?php
include "AreaRiservata/connection.php";

if (!empty($_POST["tavolo"]) & !empty($_POST["coperti"])) {
  $tavolo=$_POST["tavolo"];
  $coperti=$_POST["coperti"];

  $sql="UPDATE tavolo t SET t.coperto=$coperti WHERE t.numero=$coperti";
  $conn=connect();

  if ($conn->query($sql) === TRUE) {
    header("Location: AreaRiservata\menu.php");
  }
  else {
        echo "Errore nella query: " . $conn->error;
  }

  $conn->close();
}else{
  echo "<center><h1>Inserisci tutti i dati</h1><center>";
  header("refresh:4 url=index.php");
}
 ?>
