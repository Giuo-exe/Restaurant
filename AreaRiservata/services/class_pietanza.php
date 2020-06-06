<?php
  class pietanza{
    $nome="";
    $descrizione="";
    $tempo="";
    $foto="";
    $vegano=null;
    $prezzo=null;

    function __construct($nome,$descrizione,$tempo,$foto,$vegano,$prezzo){
       $this->nome = $nome;
       $this->descrizione = $descrizione;
       $this->tempo = $tempo;
       $this->foto = $foto;
       $this->vegano = $vegano;
       $this->prezzo = $prezzo;
    }

    function getNome(){
      return $this->nome;
    }

    function getDescrizione(){
      return $this->descrizione;
    }

    function getTempo(){
      return $this->tempo;
    }

    function getFoto(){
      return $this->foto;
    }

    function getVegano(){
      return $this->vegano;
    }

    function getPrezzo(){
      return $this->prezzo;
    }
  }

 ?>
