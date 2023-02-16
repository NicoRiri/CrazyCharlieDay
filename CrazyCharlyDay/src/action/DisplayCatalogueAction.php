<?php

namespace ccd\action;

use ccd\Element\Catalogue as ElementCatalogue;
use ccd\exception\AuthException;
use ccd\video\Catalogue;

class DisplayCatalogueAction extends Action
{

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(): string
    {
        $html = "";

        if ($this->http_method == "GET") {
            if (!isset($_SESSION['connexion']->email)) {
                $catalogue = new ElementCatalogue();


                $html = <<<END
                
                {$catalogue->render()}
                END;


            } else {
                $html .= <<<END
                <p><strong>Vous ne pouvez pas afficher le catalogue sans vous connecter au préalable !</strong></p>
                END;
            }

        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            $catalogue = new \ccd\Element\Catalogue();
            if (isset($_POST['recherche']) && !empty($_POST['recherche'])) {
                $search = $_POST['recherche'];
                $catalogue->insertRecherche($search);
            }

            //tri le catalogue
            if (sizeof($catalogue->series)>=2 && isset($_POST['attribut']) && isset($_POST['tri'])) {
                $tri = $_POST['tri'];
                $attribut = $_POST['attribut'];
                $catalogue->tri($tri, $attribut);
            }

            //filtre
            if (isset($_POST['genre'])) {
                $catalogue->filtre_genre($_POST['genre']);
            }

            if (isset($_POST['public'])) {
                $catalogue->filtre_public($_POST['public']);
            }

            $html = <<<END
               
                {$catalogue->render()}
            END;

        }

        return $html;
    }

}