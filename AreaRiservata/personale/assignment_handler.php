<?php
session_start();



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

        $app = ($i != 0) ? $i : "";
        echo "$i<br>";
        $listacuochisession.= ($i!=$N-1 || $i != 0) ? "," : "";
      }
      echo "$cuocoadesso adesso $listacuochisession<br>";
    }else{
      $cuocoadesso=$cuochi;
      echo "Se non un array $cuocoadesso<br>";
    }
    $_SESSION["cuochitemporanei"] = $listacuochisession;
    //header("Location: assignment_pietanze.php?cuoco=$cuocoadesso");
  }else{
    //header("Location: assignment.php");
  }
}
 ?>
