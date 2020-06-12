<?php session_start();
  include "../connection.php";
  include "class_persona.php";


  function getCookers(){
    $cuochi=array();
    $cuochi=getInformation();
    $username="";
    $nome="";
    $cognome="";
    $foto="";
    $ris="";

    foreach ($cuochi as $cuoco) {
      $username = $cuoco -> getUsername();
      $nome = $cuoco -> getNome();
      $cognome = $cuoco -> getCognome();
      $foto = $cuoco -> getFoto();
      echo $username;

      $ris.= "<div class='carta'>
                  <img class='img_carta' src='../img/dipendenti/$foto'/>
                  <p class='Nome'>$nome $cognome <input type='checkbox' name='username[]' value='$username'></p>

                </div>";
      }
    return $ris;
  }

  function getInformation(){
    $sql = "SELECT c.username,c.nome,c.cognome,c.foto FROM cuoco c ";

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
              $risult[]=$oggetto;
            }
            return $risult;
          }else{
            return null;
          }
        }
  }




?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cuochi</title>
    <style>@import "../css/cuochi.css";</style>
    <script src="https://kit.fontawesome.com/84d53604d4.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#">Ristorante</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../menu.php">Menù</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>

        </form>
      </div>
    </nav>
    <center class="titolo">Scegli uno o più cuochi</center>

    <div class="contenitore">
      <form method="POST" action="assignment_handler.php">
        <div class="carte">
        <?php echo getCookers(); ?>
        </div>
        <div class="footer">
          <input type="submit" class="btn btn-success" name="Conferma" value="Conferma" id="check"></input>
        </div>
      </form>
    </div>

  </body>
</html>
