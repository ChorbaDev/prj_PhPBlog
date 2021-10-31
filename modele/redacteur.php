<?php

class redacteur
{
    private $id;
    private $nom;
    private $prenom;
    private $mail;
    private $mdp;
    private $pseudo;

//constructeur
    function __construct($nom, $prenom, $mail, $mdp, $pseudo)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->mdp = $mdp;
        $this->pseudo = $pseudo;
    }

//getters
    public final function getNom()
    {
        return $this->nom;
    }

    public final function getPrenom()
    {
        return $this->prenom;
    }

    public final function getMail()
    {
        return $this->mail;
    }

    public final function getMdp()
    {
        return $this->mdp;
    }

    public final function getPseudo()
    {
        return $this->pseudo;
    }

    //setters
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public final function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public final function setMail($mail)
    {
        $this->mail = $mail;
    }

    public final function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    public final function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }
}

?>
