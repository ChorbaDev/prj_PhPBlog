<?php

class reponse
{
    private $id;
    private $idsujet;
    private $idredacteur;
    private $daterep;
    private $textereponse;

    //constructeur
    function __construct($id, $idsujet, $idredacteur, $daterep, $textereponse)
    {
        $this->id = $id;
        $this->idsujet = $idsujet;
        $this->idredacteur = $idredacteur;
        $this->daterep = $daterep;
        $this->textereponse = $textereponse;
    }

//getters
    public final function getId()
    {
        return $this->id;
    }

    public final function getIdSujet()
    {
        return $this->idsujet;
    }

    public final function getIdRedacteur()
    {
        return $this->idredacteur;
    }

    public final function getDateRep()
    {
        return $this->daterep;
    }

    public final function getTexteReponse()
    {
        return $this->textereponse;
    }

//setters
    public final function setId($id)
    {
        $this->id = $id;
    }

    public final function setIdSujet($idsujet)
    {
        $this->idsujet = $idsujet;
    }

    public final function setIdRedacteur($idredacteur)
    {
        $this->idredacteur = $idredacteur;
    }

    public final function setDateRep($daterep)
    {
        $this->daterep = $daterep;
    }

    public final function setTexteReponse($textereponse)
    {
        $this->textereponse = $textereponse;
    }
}

?>
