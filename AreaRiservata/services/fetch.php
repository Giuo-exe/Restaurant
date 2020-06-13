<?php
session_start();
include "../connection.php";


echo $_SESSION["vegano"];
$check = $_SESSION["vegano"];
echo $check;
if($check == "si"){
}

$sql = ($check == "si") ? "SELECT * FROM pietanze p WHERE p.vegano=1 and p.nome LIKE '%".$_POST["search"]."%'" : "SELECT * FROM pietanze p WHERE p.nome LIKE '%".$_POST["search"]."%'";

echo $sql;

$conn=connect();
    $records=$conn->query($sql);
    $risult="";

    if ( $records == TRUE) {
        //echo "<br>Query eseguita!";
    } else {
      die("Errore nella query: " . $conn->error);
    }
    //gestisco gli eventuali dati estratti dalla query
    if($records->num_rows == 0){
      echo "<h2>Nessun risultato</h2>";
    }else{
      if($records){
        while($tupla=$records-> fetch_assoc()){
          $nome = $tupla['nome'];
          $foto = $tupla['foto'];
          $descrizione = $tupla['descrizione'];
          $tempo = $tupla['tempo'];

          $risult.= "<div class='carta'>
                      <img class='img_carta' src='img/$foto'/>
                      <div class='informazione_carta'>
                          <h1 class='titolo_carta'>$nome</h1>
                          <p class='testo_carta'>$descrizione</p>
                          <p class='tempo_carta'>
                              <i class='far fa-clock'></i>$tempo min</p>
                      </div>
                      <div class='operation_carta'>
                        <i class='fas fa-plus-square' id='aggiungi' onclick=''></i>
                        <i class='fas fa-minus-square' id='rimuovi'></i>
                      </div>
                    </div>";

        //createPietanza($nome,$foto,$descrizione,$tempo);
        }
        echo $risult;
      }else{
        echo "<h1>Non c'è niente da mostrare</h1>";
      }
    }
?>
