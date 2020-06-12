<?php include "AreaRiservata/connection.php";

  $login=""
?>


<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>@import "css/login.css";</style>
  </head>
  <body>
    <div class="container" id="container">
    	<div class="form-container sign-up-container">
    		<form action="auth.php" method="POST">
    			<h1>Accedi</h1>
    			<span>Inserisci i tuoi dati</span>
    			<input type="text" placeholder="Username" name="username" value="benitomussolini"/>
    			<input type="password" placeholder="Password" name="password" value="vivailduce" />
    			<input type="submit" value="Log in " id="button">
    		</form>
    	</div>
    	<div class="form-container sign-in-container">
        <form action='auth_clienti.php' method='POST'>
          <h1>Benvenuto</h1>
            <label for='tavolo'><span>Scegli un tavolo:</span></label>
            <input list='tavoli' name='tavolo' id='tavolo'>
              <datalist id='tavoli'>

                <option value="1">
                <option value="2">
                <option value="3">
                <option value="4">
                <option value="5">
                <option value="6">
                <option value="7">
                <option value="8">
                <option value="9">
                <option value="10">
              </datalist>
              <span>Numero persone:</span>
              <input type="number" name="coperti" min="1" max="50">
              <input type='submit' value='conferma' id="button">
          </form>

    	</div>
    	<div class="overlay-container">
    		<div class="overlay">
    			<div class="overlay-panel overlay-left">
    				<h1>Sei un cliente?</h1>
    				<p>Perfavore scegli un tavolo e il numero di persone</p>
    				<button class="ghost" id="signIn">Tavoli</button>
    			</div>
    			<div class="overlay-panel overlay-right">
    				<h1>Sei del personale?</h1>
    				<p>Inserisci i tuoi dati per usufruire della funzionalità del ristorante</p>
    				<button class="ghost" id="signUp">Accedi</button>
    			</div>
    		</div>
    	</div>
    </div>


    <script>
      const signUpButton = document.getElementById('signUp');
      const signInButton = document.getElementById('signIn');
      const container = document.getElementById('container');

      signUpButton.addEventListener('click', () => {
      	container.classList.add("right-panel-active");
      });

      signInButton.addEventListener('click', () => {
      	container.classList.remove("right-panel-active");
      });
    </script>

  </body>
</html>


<?php
  function getTavoli(){

      $sql = "SELECT * FROM tavolo t";
      $risult="

      <form action='' method='POST'>
        <h1>Benvenuto</h1>
          <label for='tavolo'><span>Scegli un tavolo:</span></label>
          <input list='tavoli' name='tavolo' id='tavolo'>
            <datalist id='tavoli'>";


      $conn=connect();
          $records=$conn->query($sql);

          if ( $records == TRUE) {
              //echo "<br>Query eseguita!";
          } else {
            die("Errore nella query: " . $conn->error);
          }
          //gestisco gli eventuali dati estratti dalla query
          if($records->num_rows == 0){
              return "<h2>Nessun risultato</h2>";
          }else{
            if($records){
              while($tupla=$records-> fetch_assoc()){
                $numero = $tupla["numero"];
                $coperto = $tupla["coperto"];


              $risult.="<option value='$numero'>";
              }
              echo $risult;
              exit;
            }else{
              echo "<h1>Non c'è niente da mostrare</h1>";
            }
          }

        $risult.="</datalist>
                    <input type='submit' value='conferma'>
                  </form>";
      return $risult;
  }

 ?>
