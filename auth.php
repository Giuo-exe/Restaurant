<?php
    session_start();
    include "AreaRiservata/connection.php";

  if (!empty($_POST["username"]) & !empty($_POST["password"])) {
    $user=$_POST["username"];
    $pass=md5($_POST["password"]);
      EstraiDati($user,$pass);
  }else if(isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    $user=$_COOKIE["username"];
    $pass=($_COOKIE["password"]);

      EstraiDati($user,$pass);
  }

  function EstraiDati($user,$pass){
    $chef=ifChef($user,$pass);
    $cuoco=ifCuoco($user,$pass);
    $cameriere=ifCameriere($user,$pass);
    $array=array();
    $check=0;

    if($cameriere!=null){
    echo "cameriere";
      $check=1;
      $array= explode(",",$cameriere);
    }else if($cuoco!=null){
      echo "cuoco";
      $check=1;
      $array= explode(",",$cuoco);
    }else if($chef!=null){
      echo "chef";
      $check=1;
      $array= explode(",",$chef);
    }

    if($check=1){
      $u=$array[0];
      $p=$array[1];
      $user=$array[2];
      $pass=$array[3];
      $n=$array[4];
      $c=$array[5];
      $f=$array[6];
      $t=$array[7];

      auth($u,$p,$user,$pass,$n,$c,$f,$t);
    }else{
      echo "login non andato a buon fine";
    }



  }

  function auth($u,$p,$user,$pass,$n,$c,$f,$t){
    if($user==$u && $p==$pass){
      settacookie($user,$pass);
      createToken($user,$pass);
      settasessione($u,$n,$c,$f,$t);
      echo "$t";
      if($t==="'chef'"){
        header("Location: AreaRiservata\personale/assignment.php");

      }else if($t==="'cuoco'"){
        echo "ollare ollare";
        header("Location: AreaRiservata\personale/view_cuochi.php");

      }else if($t==="'cameriere'"){
        header("Location: AreaRiservata\personale/view_camerieri.php");
      }

    }else{
      echo
      "<html>
        <head>
          <link rel='stylesheet' type='text/css' href='css/style.css'>
        </head>
        <body>
          <a href='index.php'>
            <h5>Username o password non corretti</h5>
          </a>
        </body>
      </html>";
    }
  }

  function settacookie($username,$password){
    if(!isset($_COOKIE["username"]) && !isset($_COOKIE["password"])) {
      setcookie("username", $username, time() + (60 * 30), "/");
      setcookie("password", $password, time() + (60 * 30), "/");
    }
  }

  function createToken($user,$pass){
    $random=rand(0,100000);
    $token=md5($user.$pass.$random);
    setcookie("token", $token, time() + (60 * 30), "/");
    $_SESSION["token"]=$_COOKIE["token"];
  }

  function settasessione($u,$n,$c,$f){
    $_SESSION["username"]=$u;
    $_SESSION["nome"]=$n;
    $_SESSION["cognome"]=$c;
    $_SESSION["foto"]=$f;
  }

  function ifCuoco($user,$pass){
    $sql = "SELECT c.* FROM cuoco c WHERE c.username='$user'";
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
			while($tupla=$records-> fetch_assoc()){
				$u=$tupla['username'];
				$p=$tupla['password'];
        $n=$tupla['nome'];
        $c=$tupla['cognome'];
        $f=$tupla['foto'];

			}
        return "$u,$p,$user,$pass,$n,$c,$f,'cuoco'";
		}
  }

    function ifCameriere($user,$pass){
      $sql = "SELECT c.* FROM cameriere c WHERE c.username='$user'";
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
  			while($tupla=$records-> fetch_assoc()){
  				$u=$tupla['username'];
  				$p=$tupla['password'];
          $n=$tupla['nome'];+
          $c=$tupla['cognome'];
          $f=$tupla['foto'];

  			}
          return "$u,$p,$user,$pass,$n,$c,$f,'cameriere'";
  		}
    }

      function ifChef($user,$pass){
        $sql = "SELECT c.* FROM chef c WHERE c.username='$user'";
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
    			while($tupla=$records-> fetch_assoc()){
    				$u=$tupla['username'];
    				$p=$tupla['password'];
            $n=$tupla['nome'];
            $c=$tupla['cognome'];
            $f=$tupla['foto'];

    			}
          return "$u,$p,$user,$pass,$n,$c,$f,'chef'";
    		}
  }
?>
