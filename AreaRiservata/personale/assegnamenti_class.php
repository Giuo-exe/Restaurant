<?php
class assegnamento{
  private $id_ordinazione=0;
  private $id_assegnamento=0;
  private $chef="";
  private $cuoco="";
  private $tavolo=null;
  private $orario=null;
  private $nome="";
  private $foto="";
  private $prezzo=null;

  function __construct($id_ordinazione,$id_assegnamento,$chef,$cuoco,$tavolo,$orario,$nome,$foto,$prezzo){
     $this->id_ordinazione = $id_ordinazione;
     $this->id_assegnamento = $id_assegnamento;
     $this->chef = $chef;
     $this->cuoco = $cuoco;
     $this->tavolo = $tavolo;
     $this->orario = $orario;
     $this->nome = $nome;
     $this->foto = $foto;
     $this->prezzo = $prezzo;
  }

  function getId_ordinazione(){
    return $this->id_ordinazione;
  }

  function getId_assegnamento(){
    return $this->id_assegnamento;
  }

  function getChef(){
    return $this->chef;
  }

  function getCuoco(){
    return $this->cuoco;
  }

  function getTavolo(){
    return $this->tavolo;
  }

  function getOrario(){
    return $this->orario;
  }

  function getNome(){
    return $this->nome;
  }

  function getFoto(){
    return $this->foto;
  }
  function getPrezzo(){
    return $this->prezzo;
  }




}

?>
