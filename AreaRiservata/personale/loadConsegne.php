<?php

include "../connection.php";
include "assegnamenti_class.php";


function assegnamento(){
  $risult=array();

  $username=$_SESSION["username"];


    $sql = "SELECT * FROM listaconsegne p where p.cameriere='$username' order by p.orario desc";

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
            $id_ordinazione = $tupla["id_ordinazione"];
            $id_assegnamento = $tupla["id_assegnamento"];
            $chef= $tupla["chef"];
            $cuoco = $tupla["cuoco"];
            $tavolo = $tupla["tavolo"];
            $orario = $tupla["orario"];
            $nome = $tupla["nome"];
            $foto = $tupla["foto"];
            $prezzo = $tupla["prezzo"];

            $assegnamento = new assegnamento($id_ordinazione,$id_assegnamento,$chef,$cuoco,$tavolo,$orario,$nome,$foto,$prezzo);
            $risult[]=$assegnamento;

          }
          return $risult;
        }else{
          return null;
        }
      }
  }


  function createGraphics(){
    $cuoco=$_SESSION["username"];
    $assegnamenti = assegnamento();
    $ris="";
    if(!empty($assegnamenti)){
      if(is_array($assegnamenti)){
        $N=count($assegnamenti);

        for($i=0;$i<$N;$i++){


          $tavolo= $assegnamenti[$i] -> getTavolo();
          $tavoloprecedente = $i==0 ? $tavolo : $assegnamenti[$i-1] -> getTavolo();
          $idass = $assegnamenti[$i] -> getId_assegnamento();
          $idord = $assegnamenti[$i] -> getId_ordinazione();
          $foto = $assegnamenti[$i] -> getFoto();
          $nome = $assegnamenti[$i] -> getNome();
          $cambiotavolo=false;

          if($i==0){
            $ris.="<div class='tavolo'>
              <form method='POST' action='camerieri.php?idass=$idass&idord=$idord&cuoco=$cuoco&tavolo=$tavolo'>
                <center class='numero_tavolo'>Tavolo $tavolo</center>
                <div class='carte'>";
          }

          if($tavolo==$tavoloprecedente){
            $ris.="<div class='carta'>
              <img class='img_carta' src='../img/$foto'/>
              <p class='Nome'>$nome<input type='checkbox' name='pietanze[]' value='$nome'></p>
            </div>";
          }else if($tavolo!=$tavoloprecedente){
            $cambiotavolo=true;
            $ris.="<div class='footer'>
                    <input type='submit' class='btn btn-success' name='Conferma' value='Conferma' id='check'></input>
                  </div>
                  </form>
                  </div></div>";

            $ris.="<div class='tavolo'>
              <form method='POST' action='camerieri.php?idass=$idass&idord=$idord&cuoco=$cuoco&tavolo=$tavolo'>
                <center class='numero_tavolo'>Tavolo $tavolo</center>
                <div class='carte'>";
                $ris.="<div class='carta'>
                  <img class='img_carta' src='../img/$foto'/>
                  <p class='Nome'>$nome<input type='checkbox' name='pietanze[]' value='$nome'></p>
                </div>";
          }
          if($i==$N-1){
            $ris.="<div class='footer'>
                    <input type='submit' class='btn btn-success' name='Conferma' value='Conferma' id='check'></input>
                  </div></form>
                  </div></div>";
          }
        }
      }else{

        $tavolo=$assegnamenti -> getTavolo();
        $foto = $assegnamenti -> getFoto();
        $nome = $assegnamenti -> getNome();
        $idass = $assegnamenti -> getId_assegnamento();
        $idord = $assegnamenti -> getId_ordinazione();

        $ris.="<div class='tavolo'>
          <form method='POST' action='camerieri.php?idass=$idass&idord=$idord&cuoco=$cuoco&tavolo=$tavolo'>
            <center class='numero_tavolo'>Tavolo $tavolo</center>
            <div class='carte'>";
            $ris.="<div class='carta'>
              <img class='img_carta' src='../img/$foto'/>
              <p class='Nome'>$nome<input type='checkbox' name='pietanze[]' value='$nome'></p>
            </div>";
          $ris.="<div class='footer'>
                    <input type='submit' class='btn btn-success' name='Conferma' value='Conferma' id='check'></input>
                  </div>";
      }
    }else{
      $ris.="Nessuna assegnazione";
    }
    return $ris;
  }
 ?>
