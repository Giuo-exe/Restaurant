<?php
session_start();

include "../connection.php";

if(isset($_SESSION["username"])){
  echo "sono settato";
}

if(isset($_POST["pietanze"]) && !empty($_GET["idordine"]) && !empty($_GET["cuoco"]) && isset($_SESSION["username"])) {
    echo "s";
  $chef=$_SESSION["username"];
  $pietanze=$_POST["pietanze"];
  $cuoco=$_GET["cuoco"];
  $idordine=$_GET["idordine"];
  $tavolo=null;
  if(isset($_GET["tavolo"])){
    $tavolo=$_GET["tavolo"];
  }

  $data = date("Y-m-d H:m:s");
  echo $data;

  var_dump($pietanze);

  if(is_array($pietanze)){
    echo "entro";
      $mysqli = connect();
      $mysqli -> autocommit(FALSE);

      $sqls="SELECT a.cuoco,a.ordinazione FROM assegnamentoordine a where a.cuoco = '$cuoco' and a.ordinazione='$idordine'";
      $sqlss="";
      $records = $mysqli->query($sqls);

      if ( $records == TRUE) {
      } else {
        die("Errore nella query: " . $conn->error);
      }
      //gestisco gli eventuali dati estratti dalla query
      if($records->num_rows == 0){
          echo "sono settato";
          $sqlss="INSERT INTO `assegnamentoordine` (`id`, `chef`, `cuoco`, `orario`, `ordinazione`) VALUES (NULL, '$chef', '$cuoco', '$data', '$idordine')";
          echo $sqlss;
          $mysqli -> query($sqlss);
      }

      foreach ($pietanze as $pietanza) {
        $sql="UPDATE relativa r SET r.cuoco='$cuoco' WHERE r.pietanza='$pietanza' AND r.ordinazione='$idordine'";


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


    $sqls="SELECT a.cuoco,a.ordinazione FROM assegnamentoordine a where a.cuoco = '$cuoco' and a.ordinazione='$idordine'";
    $sqlss="";
    $records = $mysqli->query($sqls);

    if ( $records == TRUE) {
    } else {
      die("Errore nella query: " . $conn->error);
    }
    //gestisco gli eventuali dati estratti dalla query
    if($records->num_rows == 0){
      echo "entroqui";
        $sqlss="INSERT INTO `assegnamentoordine` (`id`, `chef`, `cuoco`, `orario`, `ordinazione`) VALUES (NULL, '$chef', '$cuoco', '$data', '$idordine')";
        $mysqli -> query($sqlss);
    }



    $sql="UPDATE relativa r SET r.cuoco='$cuoco' WHERE r.pietanza='$pietanze' AND r.ordinazione='$idordine'";

    $mysqli -> query($sql);


    // Commit transaction
    if (!$mysqli -> commit()) {
      echo "Commit transaction failed";
    }

    $mysqli -> close();
  }
  header("Location: assignment_handler.php?tavolo=$tavolo");
}else{
  header("Location: assignment_handler.php?");
}


 ?>
