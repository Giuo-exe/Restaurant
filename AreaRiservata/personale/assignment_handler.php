<?php
session_start();
$tavolo=0;

if(isset($_GET["tavolo"])){
  $tavolo=$_GET["tavolo"];
}

if (!empty($_POST["username"])) {

  $cuochi=$_POST["username"];
  $listacuochisession="";
  if(is_array($cuochi)){
    $N=count($cuochi);
    for($i=0;$i<$N;$i++){
      $listacuochisession.=$cuochi[$i];

      $listacuochisession.= $i!=$N-1 ? "," : "";
    }
  }else{
    $listacuochisession.=$cuochi;
  }
  $_SESSION["cuochitemporanei"] = $listacuochisession;

  echo "al post  $listacuochisession<br>";
}

if(isset($_SESSION["cuochitemporanei"])){
  if($_SESSION["cuochitemporanei"]!=""){
    $cuocoadesso="";
    $listacuochisession="";
    $cuochi="";
    try{
      $cuochi=explode(",",$_SESSION["cuochitemporanei"]);
    }catch(Exception $e){
      $cuochi=$_SESSION["cuochitemporanei"];
    }

    var_dump($cuochi);

    if(is_array($cuochi)){
      $N=count($cuochi);
      for($i=0;$i<$N;$i++){
        if($i==0){
          $cuocoadesso=$cuochi[$i];
        }else{
          $listacuochisession.=$cuochi[$i];
        }
        echo "$i<br>";

          $listacuochisession.= $i!=0 && $i!=$N-1 ? "," : "";

      }
      echo "$cuocoadesso adesso $listacuochisession<br>";
    }else{
      $cuocoadesso=$cuochi;
      echo "Se non un array $cuocoadesso<br>";
    }
    $_SESSION["cuochitemporanei"] = $listacuochisession;
    header("Location: assignment_pietanze.php?cuoco=$cuocoadesso&tavolo=$tavolo");
  }else{
    header("Location: assignment.php");
  }
}
 ?>
