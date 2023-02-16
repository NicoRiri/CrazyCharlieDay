<?php

namespace ccd\Element;

class Produit {
    private int $id;
    private int $categorie;
    private string $nom;
    private float $prix;
    private int $poids;
    private string $description;
    private string $detail;
    private string $lieu;
    private int $distance;
    private float $latitude;
    private float $longitude;
    private string $img;

    public function __construct($id,$categorie,$nom,$prix,$poids,$description,$detail,$lieu,$distance,$latitude,$longitude,$img){
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
        $this->img = $img;
    }

    public function __get(string $at):mixed {
        if (property_exists ($this, $at)) return $this->$at;
        else throw new \Exception ("$at: invalid property");
    }

    public function render(){
        $res = "<ul>";
        $res .= <<<END
        <li>
            <figure>
                <img class="img" src='Images/$this->img' alt='Image du produit'>
                <figcaption>
                    <p1>$this->nom</p1><br>
                    <p2>{$this->prix}€</p2><br>
                    <p3>$this->description</p3><br>
                </figcaption>
            </figure>
        </li>
        END;

        return $res . "</ul>";
    }
}