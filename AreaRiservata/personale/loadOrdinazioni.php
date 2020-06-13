<?php
include "class_ordinazione.php";
include "../connection.php";


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
              $nome = $tupla["nome"];
              $foto = $tupla["foto"];
              $descrizione = $tupla["descrizione"];
              $tempo = $tupla["tempo"];
              $vegano = $tupla["vegano"];
              $prezzo = $tupla["prezzo"];
              $tavolo = $tupla["prezzo"];
              $orario = $tupla["orario"];

              $oggetto = new ordinazione(null,$nome,$descrizione,$tempo,$foto,$vegano,$prezzo,$tavolo,$orario);
              $risult[]=$oggetto;

            }
            return $risult;
          }else{
            return null;
          }
        }

    }

    function tavoli(){
      $sql = "SELECT t.numero from tavolo t where t.numero in (select l.tavolo from listaordinazioni l)";

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
                $numero = $tupla["numero"];
                $risult[]=$numero;
              }
              return $risult;
            }else{
              return null;
            }
          }
        }



    function createGraphics(){
      $ris = "";
      $tavoli=array();
      $tavoli=tavoli();
      $i=0;



      if(is_array($tavoli)){
        $ordinazioni=array();
        foreach ($tavoli as $tavolo) {
          $colorContenitore = randomColorPaletteContenitore($i%5);
          $colorSfera = randomColorPaletteSphere();

          $ris.= "<div class='sfere' id='tavolo$tavolo' style='background-color : #$colorContenitore'>
                    <div class='sfera' style='background-color : #$colorSfera'>
                      <p class='numero'>T. $tavolo</p>
                    </div>
                    <div class='contenuto'>";

          $ordinazioni = ordinazione($tavolo);

          $ris.=" <p class='pietanza'>";
          foreach ($ordinazioni as $o) {
            $pietanza = $o -> getNome();
            $foto = $o -> getFoto();


             $ris.="<img class='sferina' src='../img/$foto'></img>$pietanza ";
             //$ris.= $numero > 1 ? "x$numero " : "";
          }
          $ris.="</p></div>
          <div class=''>
            <a href='cuochi.php?tavolo=$tavolo'><button class='btn btn-success'>Assegna</button></a>
          </div>

              </div>";
            $i++;
        }
        return $ris;
      }else if($tavoli!=null){
        $ordinazioni=array();
        $colorContenitore = randomColorPaletteContenitore($i);
        $colorSfera = randomColorPaletteSphere();
        $ris.= "<div class='sfere' id='tavolo$tavolo' style='background-color : #$colorContenitore'>
                  <div class='sfera' style='background-color : #$colorSfera'>
                    <p class='numero'>T. $tavoli</p>
                  </div>
                  <div class='contenuto'>";

        $ordinazioni = ordinazione($tavoli);

        $ris.=" <p class='pietanza'>";
        foreach ($ordinazioni as $o) {
          $pietanza = $o -> getNome();
          $foto = $o -> getFoto();


          $ris.="<img class='sferina' src='../img/$foto'></img>$pietanza ";
          //$ris.= $numero > 1 ? "x$numero " : "";
        }
        $ris.="</div>
            </div>";
      return $ris;
    }else{
      $ris.="Nessun risultato";
    }

    }



    function randomColorPaletteSphere(){
      $array = array("ffb5a7","fcd5ce","f8edeb","f9dcc4","fec89a");
      $random = rand(0,(count($array)-1));
      $colore="";
      $colore = $array[$random];
      return $colore;
    }

    function randomColorPaletteContenitore($indice){
      $array = array("8e9aaf","cbc0d3","efd3d7","feeafa","dee2ff");
      $colore = $array[$indice];
      return $colore;
    }

    ?>
