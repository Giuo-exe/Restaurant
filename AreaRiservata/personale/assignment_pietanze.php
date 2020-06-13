<?php
session_start();
include "../connection.php";
include "class_persona.php";
include "class_ordinazione.php";


$cuoco="";
$tavolo=0;

if(isset($_GET["cuoco"]) && isset($_GET["tavolo"]) ){
  $cuoco=$_GET["cuoco"];
  $tavolo=$_GET["tavolo"];
  echo $tavolo;
}

$cuoco=getInformationCooker($cuoco);
$nomecuoco = $cuoco -> getNome();
$cognome= $cuoco -> getCognome();
$usercuoco = $cuoco -> getUsername();



function getAlimenti($tavolo,$usercuoco){

  $pietanze=ordinazione($tavolo);
  echo "$tavolo";


  $ris="";

  if($pietanze!=null){
    $idordine = is_array($pietanze) ? $pietanze[0] -> getId() : $pietanze -> getId();
    echo $usercuoco;
    $ris.="<form method='POST' action='assignment_add.php?tavolo=$tavolo&cuoco=$usercuoco&idordine=$idordine'>
      <div class='carte'>";
    if(is_array($pietanze)){
      foreach ($pietanze as $pietanza) {
        $nome=$pietanza -> getNome();
        $foto=$pietanza -> getFoto();

        echo $nome;
        $ris.="<div class='carta'>
            <img class='img_carta' src='../img/$foto'/>
            <p class='Nome'>$nome <input type='checkbox' name='pietanze[]' value='$nome'></p>
          </div>";
        }
      }else{
        $nome=$pietanze -> getNome();
        $foto=$pietanze -> getFoto();
        $ris.="<div class='carta'>
            <img class='img_carta' src='../img/$foto'/>
            <p class='Nome'>$nome <input type='checkbox' name='pietanze[]' value='$nome'></p>
          </div>";
      }
      $ris.="</div>
      <div class='footer'>
        <input type='submit' class='btn btn-success' name='Conferma' value='Conferma' id='check'></input>
      </div>
    </form>";
  }else{
    $ris.="Nessuna pietanza";

    header("redirect:3 url=assignment.php");
  }

  return $ris;
}

function ordinazione($tavolo){
  $risult=array();


    $sql = "SELECT * FROM listaordinazioni p where p.tavolo='$tavolo' order by p.orario desc";

    $conn=connect();
      $records=$conn->query($sql);

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
            $id = $tupla["ordinazione"];
            $nome = $tupla["nome"];
            $foto = $tupla["foto"];
            $descrizione = $tupla["descrizione"];
            $tempo = $tupla["tempo"];
            $vegano = $tupla["vegano"];
            $prezzo = $tupla["prezzo"];
            $tavolo = $tupla["prezzo"];
            $orario = $tupla["orario"];

            $oggetto = new ordinazione($id,$nome,$descrizione,$tempo,$foto,$vegano,$prezzo,$tavolo,$orario);
            $risult[]=$oggetto;

          }
          return $risult;
        }else{
          return null;
        }
      }

  }

function getInformationCooker($cuoco){
  $sql = "SELECT c.username,c.nome,c.cognome,c.foto FROM cuoco c where c.username='$cuoco'";

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
            $username = $tupla["username"];
            $nome = $tupla["nome"];
            $cognome = $tupla["cognome"];
            $foto = $tupla["foto"];
            $oggetto = new persona($username,$nome,$cognome,$foto);
          }
          return $oggetto;
        }else{
          return null;
        }
      }
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Attribuzione Cuochi</title>
  <style>@import "../css/cuochi.css";</style>
  <script src="https://kit.fontawesome.com/84d53604d4.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
  <body>
    <center class="titolo">Che piatto vuoi far cucinare a <?php echo "$nomecuoco $cognome";?>?</center>
    <div class="contenitore">
      <?php echo getAlimenti($tavolo,$usercuoco); ?>
    </div>
  </body>
</html>
