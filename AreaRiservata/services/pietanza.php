<?php
include "class_pietanza.php";
include "connection.php";
function getPietanza($pietanza){
  $sql = "SELECT * FROM pietanze p where p.nome='$pietanza'";

  $conn=connect();
      $records=$conn->query($sql);
      $risult=array();
      if ( $records == TRUE) {
          //echo "<br>Query eseguita!";
      } else {
        die("Errore nella query: " . $conn->error);
      }
      //gestisco gli eventuali dati estratti dalla query
      if($records->num_rows == 0){
          return null;
      }else{
        if($records){
          while($tupla=$records-> fetch_assoc()){
            $nome = $tupla["nome"];
            $foto = $tupla["foto"];
            $descrizione = $tupla["descrizione"];
            $tempo = $tupla["tempo"];
            $vegano = $tupla["vegano"];
            $prezzo = $tupla["prezzo"];

            $oggetto = new pietanza($nome,$descrizione,$tempo,$foto,$vegano,$prezzo);
          }
          return $oggetto;
        }else{
          return null;
        }
      }
    }
?>
