<?php
    session_start();
    include "AreaRiservata/connection.php";
    $user="";
    $pass="";

  if (!empty($_POST["username"]) & !empty($_POST["password"])) {
    $user=$_POST["username"];
    $pass=md5($_POST["password"]);
    echo $user.$pass;
      EstraiDati($user,$pass);
  }else if(isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    $user=$_COOKIE["username"];
    $pass=($_COOKIE["password"]);

      EstraiDati($user,$pass);
  }

  function EstraiDati($user,$pass){
    $sql = "SELECT p.* FROM persona p WHERE p.username='$user'";
    $conn=connect();
    $records=$conn->query($sql);
    if ( $records == TRUE) {
        //echo "<br>Query eseguita!";
    } else {
      die("Errore nella query: " . $conn->error);
    }
		//gestisco gli eventuali dati estratti dalla query
		if($records->num_rows == 0){
			echo "la query non ha prodotto risultato";
    }else{
			while($tupla=$records-> fetch_assoc()){
				$u=$tupla['username'];
				$p=$tupla['password'];
        $n=$tupla['nome'];
        $c=$tupla['cognome'];
        $e=$tupla['email'];
        $r=$tupla['ruolo'];
        $cl=$tupla['classe'];

			}
      auth($u,$p,$user,$pass,$n,$c,$e,$r,$cl);
		}
  }

  function auth($u,$p,$user,$pass,$n,$c,$e,$r,$cl){
    if($user==$u && $p==$pass){
      settacookie($user,$pass);
      createToken($user,$pass);
      settasessione($u,$n,$c,$e,$r,$cl);
      header("Location: AreaRiservata\index.php");
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

  function settasessione($u,$n,$c,$e,$r,$cl){
    $_SESSION["username"]=$u;
    $_SESSION["nome"]=$n;
    $_SESSION["cognome"]=$c;
    $_SESSION["email"]=$e;
    $_SESSION["ruolo"]=$r;
    $_SESSION["classe"]=$cl;

  }
?>