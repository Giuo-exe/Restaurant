<?php
session_start();

include "../connection.php";

if(isset($_SESSION["username"])){
  echo "sono settato";
}

if(isset($_POST["pietanze"]) && !empty($_GET["idordine"]) && !empty($_GET["cuoco"]) && isset($_SESSION["username"])) {
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

  if(is_array($pietanze)){
      $mysqli = connect();
      $mysqli -> autocommit(FALSE);
      echo "arrivo qui";
      $sqls="INSERT INTO `assegnamentoordine` (`id`, `chef`, `cuoco`, `orario`, `ordinazione`) VALUES (NULL, '$chef', '$cuoco', '$data', '$idordine')";

      $mysqli -> query($sqls);

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


    $sqls="INSERT INTO `assegnamentoordine` (`id`, `chef`, `cuoco`, `orario`, `ordinazione`) VALUES (NULL, '$chef', '$cuoco', '$data', '$idordine')";

    $mysqli -> query($sqls);

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
