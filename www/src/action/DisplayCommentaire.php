<?php

namespace ccd\action;

class DisplayCommentaire extends Action {

    public function __construct(){
        parent::__construct();
    }

    public function execute() : string{
        $html = "";
        
        if ($this->http_method=="GET") {
            if (!isset($_SESSION['connexion']->email)){
                $idserie = $_GET['idserie'];
                $serie = new \ccd\video\Serie($idserie);
                $html = <<<END
                {$serie->liste_commentaire()}
                END;
            }else{
                $html .= <<<END
                <p><strong>Vous ne pouvez pas afficher le catalogue sans vous connecter au préalable !</strong></p>
                END;
            }
            return $html;
        }
    }

}
