<?php session_start();
  include "services/load.php";
  $_SESSION["vegano"] = "no";
  ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Menù</title>
    <style>@import "css/cardview.css";</style>
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
            <a class="nav-link" href="menu.php">Menu <span class="sr-only">(current)</span></a>
          </li>
      </div>
    </nav>


    <div class="contenitore">

      <h2 align="center">Menu</h2>
      <input class="form-control mr-sm-2 my-2" type="search" placeholder="Search" aria-label="Search" id="search_text" name="search_text">
      vegano
      <label class="switch">
        <input type="checkbox" id="vegan">
        <span class="slider round"></span>
      </label>

      <div class="carte" id="result">
        <?php echo loadPietanze(); ?>
      </div>

      <div class="bottombar">
        <p id="ohfra"></p>
        <input type="submit" class="btn btn-success" name="cart" value="cart" id="carrello">Vai al carrello</input>
        <button type="submit" class="btn btn-success" name="cart" value="cart" id="carrello" >Vai al carrello</button>
      </div>
    </div>







    <script>


     $(function(){
        $('#vegan').click(function(){
          if ($(this).is(':checked')) {
            $('#result').html("");
            $('#ohfra').html("fram è si");
            <?php $_SESSION["vegano"] = "no";?>

            $('#result').html('<?php loadVegan(); ?>');
          }else{
            $('#result').html("");
            $('#ohfra').html("è no");
            <?php $_SESSION["vegano"] = "no";?>

            $('#result').html('<?php loadPietanze(); ?>');
          }
        });
      });

      $(document).ready(function(){
          $('#search_text').keyup(function(){
            var txt = $(this).val();
            $('#result').html("");
            $.ajax({
                url:"services/fetch.php",
                method:"post",
                data:{search:txt},
                dataType:"text",
                success:function(data)
                {
                    $('#result').html(data);
                }
            });
          });
      });

      

      //add carrello
      function addFood(nome){
        document.getElementById("ohfra").innerHTML = nome;
      }

      </script>

  </body>
</html>

<?php

  function carrello(){
    header("Location: cart.php");
  }


  function getNomePietanza($nome){
    $Paolo = $nome;
    echo "<script type='text/javascript'>
     addFood(\"$nome\");
     </script>"
     ;
     echo "vediamo se funziona";
  }
?>
