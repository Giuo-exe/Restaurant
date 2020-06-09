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

    foreach ($app as $pietanza => $numero) {

      $a = getPietanza($pietanza);
      $foto = $a != null ? $a -> getFoto() : " ";

      $risult.= "<div class='carta'>
                  <img class='img_carta' src='img/$foto'/>
                  <p class='numero_carta'>x$numero</p>
                </div>";
      }
    return $risult;
  }
 ?>


 <!DOCTYPE html>
 <html lang="it" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Carrello</title>
     <style>@import "css/cart.css";</style>
   </head>
   <body>
     <div class="contenitore">
       <div class="carte">
         <?php echo getCarrello();?>
       </div>
       <div class="footer">
         <p class="sommario">Il costo è di:</p>
       </div>
     </div>
   </body>
 </html>
