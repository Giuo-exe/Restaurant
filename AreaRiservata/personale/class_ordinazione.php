<?php
  class ordinazione{
    private $id=null;
    private $nome="";
    private $descrizione="";
    private $tempo="";
    private $foto="";
    private $vegano=null;
    private $prezzo=null;
    private $tavolo=null;
    private $orario=null;

    function __construct($id,$nome,$descrizione,$tempo,$foto,$vegano,$prezzo,$tavolo,$orario){
       $this->id = $id;
       $this->nome = $nome;
       $this->descrizione = $descrizione;
       $this->tempo = $tempo;
       $this->foto = $foto;
       $this->vegano = $vegano;
       $this->prezzo = $prezzo;
       $this->tavolo = $tavolo;
       $this->orario = $orario;
    }

    function getId(){
      return $this->id;
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

    function getTavolo(){
      return $this->tavolo;
    }

    function getOrario(){
      return $this->orario;
    }
  }

 ?>
