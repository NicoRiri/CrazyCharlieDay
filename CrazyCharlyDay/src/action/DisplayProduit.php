<?php

namespace ccd\action;

use ccd\Element\Produit;
use ccd\video\Episode;

class DisplayProduit extends Action
{

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(): string
    {
        $html = "";
            if (isset($_SESSION['connexion'])) {
                $idProduit = $_GET['idproduit'];
                $sql = "select * from produit where produit.id = ?";
                $stmt = \ccd\db\ConnectionFactory::$db->prepare($sql);
                $stmt->bindParam(1, $idProduit);
                $stmt->execute();

                $data = $stmt->fetch(\PDO::FETCH_ASSOC);
                $produit = new Produit($data['id'], $data['categorie'], $data['nom'], $data['prix'], $data['poids'], $data['description'], $data['detail'], $data['lieu'], $data['distance'], $data['latitude'], $data['longitude']);
                $html = <<<END
                {$produit->render()}
                END;
            }
            /*else {
                $html .= <<<END
                <p><strong>Vous ne pouvez pas afficher le catalogue sans vous connecter au préalable !</strong></p>
                END;
            }
            */
        return $html;
    }

    public function ajoutProduitEnCours(Episode $produit, string $id_user)
    {
        try {
            $id = $produit->id;

            $connexion = \ccd\db\ConnectionFactory::makeConnection();
            $stmt = $connexion->prepare("insert into ep_vision values('$id','$id_user',null,null)");
            $stmt->execute();
        } catch (\PDOException $ignored) {

        }


    }

}