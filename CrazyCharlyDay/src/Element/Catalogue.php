<?php

namespace ccd\Element;

use ccd\db\ConnectionFactory;
use mysql_xdevapi\Exception;

class Catalogue
{
    protected array $produits;

    public function __construct()
    {
        $this->produits = [];
        $sql = "select id, categorie, nom, prix, poids, description, detail, lieu, distance, latitude, longitude, img
        from produit";
        $res = ConnectionFactory::$db->prepare($sql);
        $res->execute();

        while ($data = $res->fetch()) {
            $s = new Produit($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11]);
            array_push($this->produits, $s);
        }
    }

    public function __get(string $at): mixed
    {
        if (property_exists($this, $at)) {
            return $this->$at;
        } else {
        throw new Exception("plouf");
        }
    }



    public function render(): string
    {
        $res = "<ul>";

        foreach ($this->produits as $tP => $v) {
            $res .= <<<END
            <li>
                <figure>
                    <img class="img" src='Images/$v->img' alt='Image du produit'>
                    <figcaption>
                        <a href="index.php?action=DisplayProduit&idproduit=$v->id">$v->nom</a>
                    </figcaption>
                </figure>
            </li>
            END;
        }

        return $res . "</ul>";
    }


    public function tri($ordre, $attribut)
    {
        if ($attribut === "nb_episode") {
            if ($ordre === 'croissant') {
                usort($this->produits, fn($a, $b) => sizeof($a->episode) <=> sizeof($b->episode));
            } elseif ($ordre === 'decroissant') {
                usort($this->produits, fn($a, $b) => sizeof($b->episode) <=> sizeof($a->episode));
            }
        } elseif ($attribut === "note") {
            if ($ordre === 'croissant') {
                usort($this->produits, fn($a, $b) => $a->calculnote() <=> $b->calculnote());
            } elseif ($ordre === 'decroissant') {
                usort($this->produits, fn($a, $b) => $b->calculnote() <=> $a->calculnote());
            }
        } elseif ($ordre == 'croissant') {
            usort($this->produits, fn($a, $b) => $a->$attribut <=> $b->$attribut);
        } elseif ($ordre === 'decroissant') {
            usort($this->produits, fn($a, $b) => $b->$attribut <=> $a->$attribut);
        }

    }

    public function insertRecherche(string $search)
    {
        foreach ($this->produits as $key => $serie) {
            if ((!str_contains($serie->titre, $search)) && (!str_contains($serie->descriptif, $search))) {
                unset($this->produits[$key]);
            }
        }
    }

    public function filtre_genre(string $string){
        if ($string !=""){
            foreach($this->produits as $key => $serie){
                if ($serie->genre!=$string) unset($this->produits[$key]);
            }
        } 
    }

    public function filtre_public(string $string){
        if ($string != ""){
            foreach($this->produits as $key => $prod){
                if ($prod->public!=$string) unset($this->produits[$key]);
            }
        }
    }
}