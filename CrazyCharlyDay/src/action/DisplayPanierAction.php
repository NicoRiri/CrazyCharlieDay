<?php

namespace ccd\action;
use ccd\action\Action;
use ccd\db\ConnectionFactory;

class DisplayPanierAction extends Action
{


    
    /**
     * @return string
     */
    public function execute(): string
    {
        $html = "";
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (isset($_SESSION['connexion'])) {
                $id_user = $_SESSION['connexion']->getId();
                //récupère panier du client
                $panier = new \ccd\Element\Panier($id_user);
                $p = $panier->produits;
                //récupère catalogue
                $catalogue = (new \ccd\Element\Catalogue())->produits;
                //tableau des produits du panier
                $html .= "<table>";
                $html .= "<tr><th>Produit</th><th>Prix</th><th>Quantité</th></tr>";
                foreach ($p as $key => $produit_panier) {
                    foreach ($catalogue as $key => $produit_catalogue) {
                        if ($produit_panier->id === $produit_catalogue->id) {
                            $html .= "<tr><td>{$produit_catalogue->nom}</td><td>{$produit_catalogue->prix}</td><td>{$produit_panier->quantite}</td></tr>";
                        }
                    }
                }
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
        }
        return $html;
    }
}
