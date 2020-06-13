<?php
session_start();

include "../connection.php";
echo $_SESSION["pietanzetemporanee"];
if(!empty($_GET["idass"]) && !empty($_GET["idord"]) && isset($_SESSION["pietanzetemporanee"]) && isset($_SESSION["username"]) && isset($_POST["cameriere"])) {
  $chef=$_SESSION["username"];
  $pietanz=$_SESSION["pietanzetemporanee"];
  $cameriere=$_POST["cameriere"];
  $idassegnamento=$_GET["idass"];
  $idord=$_GET["idord"];
  $tavolo=null;
  $cuoco=$_SESSION["username"];

  if(isset($_GET["tavolo"])){
    $tavolo=$_GET["tavolo"];
  }

  $data = date("Y-m-d H:m:s");
  echo $data;

  $pietanze=explode(",",$pietanz);

  var_dump($pietanze);

  if(is_array($pietanze)){
    echo "entro";
      $mysqli = connect();
      $mysqli -> autocommit(FALSE);

      $sqls="SELECT c.cuoco,c.assegnamento FROM consegna c where c.cameriere = '$cameriere' and c.assegnamento='$idassegnamento'";
      $sqlss="";
      $records = $mysqli->query($sqls);

      //gestisco gli eventuali dati estratti dalla query
      if ( $records == TRUE) {
      } else {
        die("Errore nella query: " . $conn->error);
      }
      if($records->num_rows == 0){
          $sqlss="INSERT INTO `consegna` (`id`, `cameriere`, `cuoco`, `orario`, `assegnamento`) VALUES (NULL, '$cameriere', '$cuoco', '$data', '$idassegnamento')";
          $mysqli -> query($sqlss);
          echo "ci sono";
      }

      foreach ($pietanze as $pietanza) {
        $sql="UPDATE relativa r SET r.cameriere='$cameriere' WHERE r.pietanza='$pietanza' AND r.ordinazione='$idord'";


        $mysqli -> query($sql);
      }

      // Commit transaction
      if (!$mysqli -> commit()) {
        echo "Commit transaction failed";
      }

      $mysqli -> close();


  }else{
    echo "arrivo qui";
      $mysqli=connect();
    $mysqli -> autocommit(FALSE);


    $sqls="SELECT c.cuoco,c.assegnamento FROM consegna c where c.cameriere = '$cameriere' and c.assegnamento='$idassegnamento'";


    $sqlss="";
    $records = $mysqli->query($sqls);

    if ( $records == TRUE) {
    } else {
      die("Errore nella query: " . $conn->error);
    }
    //gestisco gli eventuali dati estratti dalla query
    if($records->num_rows == 0){
      $sqlss="INSERT INTO `consegna` (`id`, `cameriere`, `cuoco`, `orario`, `assegnamento`) VALUES (NULL, '$cameriere', '$cuoco', '$data', '$idassegnamento')";

        $mysqli -> query($sqlss);
    }



    $sql="UPDATE relativa r SET r.cameriere='$cameriere' WHERE r.pietanza='$pietanza' AND r.ordinazione='$idord'";


    $mysqli -> query($sql);


    // Commit transaction
    if (!$mysqli -> commit()) {
      echo "Commit transaction failed";
    }

    $mysqli -> close();
  }
  header("Location: view_cuochi.php");
}else{
  header("Location: view_cuochi.php");
}




/*ADD*/

if(isset($_GET["tavolo"])){
  $tavolo=$_GET["tavolo"];
}

if (!empty($_POST["pietanze"])) {

  $pietanze=$_POST["username"];
  $listapietanzesessione="";
  if(is_array($pietanze)){
    $N=count($pietanze);
    for($i=0;$i<$N;$i++){
      $listacuochisession.=$pietanze[$i];

      $listapietanzesessione.= $i!=$N-1 ? "," : "";
    }
  }else{
    $listapietanzesessione.=$pietanze;
  }
  $_SESSION["pietanzetemporanee"] = $listapietanzesessione;

  echo "al post  $listacuochisession<br>";
}








 ?>
