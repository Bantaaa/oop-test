<?php

interface ILivre {
    public function getTitre();
    public function getAuteur();
    public function getISBN();
    public function getEditeur();
    public function getGenre();
    public function getCopiesDisponibles();
    public function setTitre($titre);
    public function setAuteur($auteur);
    public function setISBN($isbn);
    public function setEditeur($editeur);
    public function setGenre($genre);
    public function setCopiesDisponibles($copiesDisponibles);
}


interface IUtilisateur{
    public function getNom();
    public function getPrenom();
    public function getAdresse();
    public function getNumeroTelephone();
    public function getEmail();
    public function setNom($nom);
    public function setPrenom($prenom);
    public function setAdresse($adresse);
    public function setNumeroTelephone($numeroTelephone);
    public function setEmail($email);
}

interface IEmprunt {
    public function getDateEmprunt();
    public function getDateRetourPrevue();
    public function setDateEmprunt($dateEmprunt);
    public function setDateRetourPrevue($dateRetourPrevue);
}


abstract class Livre implements ILivre {
    public $titre;
    public $auteur;
    public $ISBN;
    public $editeur;
    public $genre;
    public $copiesDisponibles;

    public $livres = [];

    public function __construct($titre, $auteur, $ISBN , $editeur , $genre, $copiesDisponibles)
    {
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->ISBN = $ISBN;
        $this->editeur = $editeur;
        $this->genre = $genre;
        $this->copiesDisponibles = $copiesDisponibles;
        $this->livres[] = $this;
    }


    public function supprimerLivre()
    {
        $this->titre = null;
        $this->auteur = null;
        $this->ISBN = null;
        $this->editeur = null;
        $this->genre = null;
        $this->copiesDisponibles = null;
        
        $index = array_search($this->titre, $this->livres);

        if($index !== false)
        {
            unset($this->livres[$index]);
        }
    }

    public function modifierLivre($titre, $auteur, $ISBN , $editeur, $genre , $copiesDisponibles)
    {
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->ISBN = $ISBN;
        $this->editeur = $editeur;
        $this->genre = $genre;
        $this->copiesDisponibles = $copiesDisponibles;
    }
    public function getTitre(){
        return $this->titre;
    }

    public function getAuteur(){
        return $this->auteur;
    }

    public function getISBN(){
        return $this->ISBN;
    }

    public function getEditeur(){
        return $this->editeur;
    }

    public function getGenre(){
        return $this->genre;
    }

    public function getCopiesDisponibles(){
        return $this->copiesDisponibles;
    }

    public function setTitre($titre){
        $this->titre = $titre;
    }

    public function setAuteur($auteur){
        $this->auteur = $auteur;
    }

    public function setISBN($isbn){
        $this->ISBN = $isbn;
    }

    public function setEditeur($editeur){
        $this->editeur = $editeur;
    }

    public function setGenre($genre){
        $this->genre = $genre;
    }

    public function setCopiesDisponibles($copiesDisponibles){
        $this->copiesDisponibles = $copiesDisponibles;
    }
}

class Utilisateur implements IUtilisateur {
    public $nom;
    public $prenom;
    public $adresse;
    public $numeroTelephone;
    public $email;

    public function __construct($nom , $prenom, $adresse, $numeroTelephone, $email)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->numeroTelephone = $numeroTelephone;
        $this->email = $email;
    }

    public function supprimerUtilisateur()
    {
        $this->nom = null;
        $this->prenom = null;
        $this->adresse = null;
        $this->numeroTelephone = null;
        $this->email = null;
    }

    public function modifierUtilisateur($nom , $prenom, $adresse, $numeroTelephone, $email)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->numeroTelephone = $numeroTelephone;
        $this->email = $email;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getAdresse(){
        return $this->adresse;
    }

    public function getNumeroTelephone(){
        return $this->numeroTelephone;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    public function setAdresse($adresse){
        $this->adresse = $adresse;
    }

    public function setNumeroTelephone($numeroTelephone){
        $this->numeroTelephone = $numeroTelephone;
    }

    public function setEmail($email){
        $this->email = $email;
    }
}

class Emprunt implements IEmprunt {
    public $dateEmprunt;
    public $dateRetourPrevue;

    public $statut;

    public $emprunts = [];

    public function __construct($dateEmprunt, $dateRetourPrevue)
    {
        $this->dateEmprunt = $dateEmprunt;
        $this->dateRetourPrevue = $dateRetourPrevue;
        $this->emprunts[] = "date de l'emprunt :". $this->dateEmprunt . "date retour prevue : " . $this->dateRetourPrevue;
    }

    public function checkAvailability()
    {
        if($this->statut = "returned")
        {
            echo "available";
        }
        else
            echo "not available";
    }

    public function bookReturned()
    {
        $this->statut = "returned";
    }

    public function bookTaken()
    {
        $this->statut = "taken";
    }

    public function getDateEmprunt(){
        return $this->dateEmprunt;
    }

    public function getDateRetourPrevue(){
        return $this->dateRetourPrevue;
    }

    public function setDateEmprunt($dateEmprunt){
        $this->dateEmprunt = $dateEmprunt;
    }

    public function setDateRetourPrevue($dateRetourPrevue){
        $this->dateRetourPrevue = $dateRetourPrevue;
    }
}

class Administrateur extends Utilisateur {
    public $idAdmin;

    public function __construct()
    {

    }

    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    public function setIdAdmin($idAdmin)
    {
        $this->idAdmin = $idAdmin;
    }
}

class EmpruntLivre extends Emprunt {
    public $livre;
    public $utilisateur;
    public $statut;

    public function __construct()
    {

    }

    public function getLivre()
    {
        return $this->livre;
    }

    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function setLivre($livre)
    {
        $this->livre = $livre;
    }

    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }

    public function setStatut($statut)
    {
        $this->statut = $statut;
    }
}