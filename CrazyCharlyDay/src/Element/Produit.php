<?php

namespace ccd\Element;

class Produit {
    private int $id;
    private int $categorie;
    private string $nom;
    private double $prix;
    private int $poids;
    private string $description;
    private string $detail;
    private string $lieu;
    private int $distance;
    private float $latitude;
    private float $longitude;

    public function __construct($id,$categorie,$nom,$prix,$poids,$description,$detail,$lieu,$distance,$latitude,$longitude){
        $this->id = $id;
        $this->categorie = $categorie;
        $this->nom = $nom;
        $this->prix = $prix;
        $this->poids = $poids;
        $this->description = $description;
        $this->detail = $detail;
        $this->lieu = $lieu;
        $this->distance = $distance;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function __get(string $at):mixed {
        if (property_exists ($this, $at)) return $this->$at;
        else throw new \Exception ("$at: invalid property");
    }
}