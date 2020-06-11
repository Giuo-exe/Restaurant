<?php
  include "services/pietanza.php";
  session_start();

  if(isset($_SESSION["carrello"])){

    }


  function getCarrello(){
    $carrello=[];
    $carrello = explode(" , ","a , b , c , d , Crabby Patty , Caffé , Cinese Abbrostolito Scemo Infame stupido , Cinese Abbrostolito Scemo Infame stupido , Cinese Abbrostolito Scemo Infame stupido , Acqua Naturale 1L , Pizza , Gelato , Pasta , Pizza , Pizza , Pasta");
    $app=[];
    $app = array_count_values($carrello);
    $risult="";
    $foto="";
    $costo=0;

    foreach ($app as $pietanza => $numero) {

      $a = getPietanza($pietanza);
      $foto = $a != null ? $a -> getFoto() : " ";


      $costo = $a != null ? $costo + ($a -> getPrezzo()) : $costo+0;

      $risult.= "<div class='carta'>
                  <img class='img_carta' src='img/$foto'/>
                  <p class='numero_carta'>x$numero</p>
                </div>";
      }
    $_SESSION["costo"]=$costo;
    return $risult;
  }
 ?>


 <!DOCTYPE html>
 <html lang="it" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Carrello</title>
     <style>@import "css/cart.css";</style>
     <script src="https://kit.fontawesome.com/84d53604d4.js" crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   </head>
   <body>
     <div class="contenitore">
       <div class="carte">
         <?php echo getCarrello();?>
       </div>
       <div class="footer">
         <p class="sommario">Il costo è di: <?php echo $_SESSION["costo"]; ?>€</p>
         <div class="col-md-12">
           <button type="button" class="btn btn-success">Conferma</button>
         </div>
       </div>
     </div>
   </body>
 </html>
