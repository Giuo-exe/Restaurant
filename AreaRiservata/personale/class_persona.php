<?php
class persona{
  private $username="";
  private $nome="";
  private $cognome="";
  private $foto="";

  function __construct($username,$nome,$cognome,$foto){
     $this->username = $username;
     $this->nome = $nome;
     $this->cognome = $cognome;
     $this->foto = $foto;
  }

  function getUsername(){
    return $this->nome;
  }

  function getNome(){
    return $this->nome;
  }

  function getCognome(){
    return $this->cognome;
  }

  function getFoto(){
    return $this->foto;
  }
}
 ?>
