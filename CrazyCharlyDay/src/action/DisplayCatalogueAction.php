<?php

namespace ccd\action;

use ccd\Element\Catalogue as ElementCatalogue;
use ccd\exception\AuthException;
use ccd\video\Catalogue;

class DisplayCatalogueAction extends Action
{
    private ElementCatalogue $cat;

    public function __construct()
    {
        parent::__construct();
        $this->cat = new ElementCatalogue();
    }

    public function execute(): string
    {
        $html = "";

        if ($this->http_method == "GET") {
            if (!isset($_SESSION['connexion']->email)) {


                $html = <<<END
                <p class="text-center paginator" data-max_limit="{$this->cat->nbPages()}" data-paginate="">
                    <form id="recherche" method="post" action="index.php?action=DisplayCatalogueAction">
                        {$this->cat->setPageMoins()}
                        <button class="btn_xs btn_primary" disabled="disabled" data-limit="0"> &lt; </button>
                    </form>
                    <input type="text" name="limit" title="page" value="{$this->cat->__get("numPage")}" class="input-jr" min="0" max="{$this->cat->nbPages()}">
                    <span> / {$this->cat->nbPages()}</span>
                    <form id="recherche" method="post" action="index.php?action=DisplayCatalogueAction">
                        {$this->cat->setPagePlus()}
                        <button class="btn_xs btn_primary" data-limit="1"> &gt; </button>
                    </form>
                </p>
                {$this->cat->tabProdPage()}
                {$this->cat->render()}
                END;


            } else {
                $html .= <<<END
                <p><strong>Vous ne pouvez pas afficher le catalogue sans vous connecter au préalable !</strong></p>
                END;
            }

        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            
            if (isset($_POST['recherche']) && !empty($_POST['recherche'])) {
                $search = $_POST['recherche'];
                $this->cat->insertRecherche($search);
            }

            //tri le catalogue
            if (sizeof($this->cat->produits)>=2 && isset($_POST['attribut']) && isset($_POST['tri'])) {
                $tri = $_POST['tri'];
                $attribut = $_POST['attribut'];
                $this->cat->tri($tri, $attribut);
            }

            //filtre 
            if (isset($_POST['genre'])) {
                $this->cat->filtre_genre($_POST['genre']);
            }
            
            if (isset($_POST['public'])) {
                $this->cat->filtre_public($_POST['public']);
            }

            $html = <<<END
                <p class="text-center paginator" data-max_limit="{$this->cat->nbPages()}" data-paginate="">
                    <form id="recherche" method="post" action="index.php?action=DisplayCatalogueAction">
                        {$this->cat->setPageMoins()}
                        <button class="btn_xs btn_primary" data-limit="0"> &lt; </button>
                    </form>
                    <input type="text" name="limit" title="page" value="{$this->cat->__get("numPage")}" class="input-jr" min="0" max="{$this->cat->nbPages()}">
                    <span> / {$this->cat->nbPages()}</span>
                    <form id="recherche" method="post" action="index.php?action=DisplayCatalogueAction">
                        {$this->cat->setPagePlus()}
                        <button class="btn_xs btn_primary" data-limit="1"> &gt; </button>
                    </form>
                </p>
                {$this->cat->tabProdPage()}

                {$this->cat->render()}
                
            END;

        }

        return $html;
    }


}