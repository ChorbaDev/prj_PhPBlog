<?php
  class sujet{
    private $id;
    private $idredacteur;
    private $titresujet;
    private $textesujet;
    private $datesujet;
    private $theme;
    private $image;
    private $publie;

    function __construct($idredacteur,$titresujet,$textesujet,$datesujet,$theme,$image,$publie){
        $this->idredacteur=$idredacteur;
        $this->titresujet=$titresujet;
        $this->textesujet=$textesujet;
        $this->datesujet=$datesujet;
        $this->theme=$theme;
        $this->image=$image;
        $this->publie=$publie;
    }

  //getters
    public final function getId(){
        return $this->id;
    }
    public final function getIdRedacteur(){
        return $this->idredacteur;
    }
    public final function getTitreSujet(){
        return $this->titresujet;
    }
    public final function getTexteSujet(){
        return $this->textesujet;
    }
    public final function getDateSujet(){
        return $this->datesujet;
    }
    public final function getTheme(){
        return $this->theme;
    }
    public final function getImage(){
        return $this->image;
    }
    public final function getPublie(){
        return $this->publie;
    }
    //setters
    public function setId($id){
        $this->id = $id;
    }
    public function setIdRedacteur($idredacteur){
      $this->idredacteur=$idredacteur;
    }
    public function setTitreSujet($id){
      $this->titresujet=$titresujet;
    }
    public function setTexteSujet($textesujet){
      $this->textesujet=$textesujet;
    }
    public function setDateSujet($datesujet){
      $this->datesujet=$datesujet;
    }
    public function setTheme($theme){
      $this->theme=$theme;
    }
    public function setImage($image){
      $this->image=$image;
    }
    public function setPublie($publie){
      $this->publie=$publie;
    }

  }
?>
