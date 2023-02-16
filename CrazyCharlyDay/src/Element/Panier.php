<?php

namespace ccd\Element;

class Panier {
    
        private array $produits;
    
        public function __construct(){
            $this->produits = array();
        }
    
        public function __get(string $at):mixed {
            if (property_exists ($this, $at)) return $this->$at;
            else throw new \Exception ("$at: invalid property");
        }
    
        public function addProduit(Produit $produit):void{
            $this->produits[] = $produit;
        }

}