<?php
include "class_pietanza.php";
function getPietanze(){
  $sql = "SELECT * FROM pietanze";

  $conn=connect();
      $records=$conn->query($sql);
      $risult=[];
      if ( $records == TRUE) {
          //echo "<br>Query eseguita!";
      } else {
        die("Errore nella query: " . $conn->error);
      }
      //gestisco gli eventuali dati estratti dalla query
      if($records->num_rows == 0){
          return "<h2>Nessun risultato</h2>";
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
            $risult = $oggetto;
          }
          return $risult;
        }else{
          echo "<h1>Non c'è niente da mostrare</h1>";
        }
      }
    }
?>
