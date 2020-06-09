<?php
include "class_ordinazione.php";
include "connection.php";

  function ordinazione($tavolo){
    $risult=array();

    echo "<br>questo è il tavolo<br> $tavolo";

      $sql = "SELECT * FROM listaordinazioni p where p.tavolo='$tavolo'";

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
              echo "<br>sto passando per il ciclo<br>";
              $nome = $tupla["nome"];
              $foto = $tupla["foto"];
              $descrizione = $tupla["descrizione"];
              $tempo = $tupla["tempo"];
              $vegano = $tupla["vegano"];
              $prezzo = $tupla["prezzo"];
              $tavolo = $tupla["prezzo"];
              $orario = $tupla["orario"];

              $oggetto = new ordinazione($nome,$descrizione,$tempo,$foto,$vegano,$prezzo,$tavolo,$orario);
              $risult=$oggetto;

            }
            return $risult;
          }else{
            return null;
          }
        }

    }

    function tavoli(){
      $sql = "SELECT t.numero from tavolo t where t.numero in (select o.tavolo from ordinazione o)";

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
                $risult=$numero;
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



      if(is_array($tavoli)){
        $ordinazioni=array();
        foreach ($tavoli as $tavolo) {
          $ris.= "<div class='sfere' id='tavolo$tavolo'>
                    <div class='sfera'>
                      <p class='numero'>tavolo $tavolo</p>
                    </div>
                    <div class='contenuto'>";

          $ordinazioni = ordinazione($tavolo);

          foreach ($ordinazioni as $o) {
            $pietanza = $o -> getNome();
            $foto = $o -> getFoto();


            $ris.=" <p class='pietanza'> <img class='sferina' src=''../img/$foto'> $pietanza</img></p>";
          }
          $ris.="</div>
              </div>";

        }
        return $ris;
      }else if($tavoli!=null){
        $ordinazioni=array();
        $ris.= "<div class='sfere' id='tavolo$tavoli'>
                  <div class='sfera'>
                    <p class='numero'>tavolo $tavoli</p>
                  </div>
                  <div class='contenuto'>";

        $ordinazioni = ordinazione($tavoli);

        foreach ($ordinazioni as $o) {
          echo "entro";
          $pietanza = $o -> getNome();
          $foto = $o -> getFoto();


          $ris.=" <p class='pietanza'> <img class='sferina' src=''../img/$foto'></img> $pietanza</p>";
        }
        $ris.="</div>
            </div>";
      return $ris;
    }else{
      $ris.="Nessun risultato";
    }

    }

    ?>
