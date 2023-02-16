<?php

namespace ccd\dispatch;

use ccd\Element\User;

class Dispatcher
{
    private $action;

    public function __construct($action)
    {
        $this->action = $action;
    }


    public function run(): void
    {
        switch ($this->action) {
            case 'DisplaySerieAction':
                $stmt = new \ccd\action\DisplaySerieAction();
                $str = $stmt->execute();
                $this->renderPage($str,"", "");
                break;
            case 'DisplayCatalogueAction':
                $stmt = new \ccd\action\DisplayCatalogueAction();
                $str = $stmt->execute();
                $this->renderPage($str, "", "");
                break;

            case 'DisplayProduit':
                $stmt = new \ccd\action\DisplayProduit();
                $str = $stmt->execute();
                $this->renderPage($str, "", "");
                break;

            case 'identification':
                $stmt = new \ccd\action\IdentificationAction();
                $str = $stmt->execute();
                $this->renderPage("", "", $str);
                break;

            case 'inscription':
                $stmt = new \ccd\action\InscriptionAction();
                $str = $stmt->execute();
                $this->renderPage("",$str, "");
                break;

            case 'DisplaySerieEnCoursAction':
                $stmt = new \ccd\action\DisplaySerieEnCoursAction();
                $str = $stmt->execute();
                $this->renderPage($str, "", "");
                break;

            case 'ajouterinfo':
                $stmt = new \ccd\action\AjouterPlusInfoAction();
                $str = $stmt->execute();
                $this->renderPage($str, "", "");
                break;
            case 'DisplayCommentaire':
                $stmt = new \ccd\action\DisplayCommentaire();
                $str = $stmt->execute();
                $this->renderPage($str, "", "");
                break;

            case 'activationToken':
                $stmt = new \ccd\action\ActivationTokenAction();
                $str = $stmt->execute();
                $this->renderPage($str, "", "");
                break;

            case 'DisplaySerieTermine':
                $stmt = new \ccd\action\DisplaySerieTermine();
                $str = $stmt->execute();
                $this->renderPage($str, "", "");
                break;

            case 'mdpOublie':
                $stmt = new \ccd\action\MdpOublieAction();
                $str = $stmt->execute();
                $this->renderPage($str, "", "");
                break;

            case 'deconnexion':
                "oui";
                $stmt = new \ccd\action\DeconnexionAction();
                $str = $stmt->execute();
                $this->renderPage($str, "", "");
                break;

            case 'DisplayPanierAction':
                $stmt = new \ccd\action\DisplayPanierAction();
                $str = $stmt->execute();
                $this->renderPage($str, "", "");
                break;

            default :
                $stmt = new \ccd\action\IdentificationAction();
                $str = $stmt->execute();
                $this->renderPage($str, "", "");
                break;
        }


    }

    private function renderPage(string $html, string $log = "", string $sign = ""): void
    {
        $co = "";
        if (!isset($_SESSION['connexion'])){
            $co = <<<END
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="./../../style.css">
                <title>Accueil</title>
            </head>
            <body>
            <header>
                <header class = "monpetitheader" id="pourreglersoucis">
                        <h1 class = "titre_header">Court Circuit Nancy</h1>     
            
                </header>
            </header>

            <div class ="pasdidee">
            <p class="pasdidee1">Bienvenue sur</p>
            <p class = "pasdidee2"> Le site de court circuit<br>de click & collect</p>
            <a class = "pasdidee3" href="#test" class="trialsfusion">&darr;</a>
                        </div>
            
            <div class ="sign">
            <section class="sectionlog" id="test">
                <h1>Inscription</h1>
                <form id="inscription" method="post" action="index.php?action=inscription"><br>
                <label>Email : </label>
                <input name="email" type="email" placeholder="<email>"><br>
                <label>Mot de passe : </label>
                <input name="password" type="password" placeholder="<password>">
                <button type="submit">valider</button>
                </form>
                <p class = "error">$log</p>
            </section>
            
            <section class="sectionsign">
                <h1>Connexion</h1>
                <form id="connexion" method="post" action="index.php?action=identification">
                <label>&nbsp;Email : </label>
                <input name="email" type="email" placeholder="<email>"><br>
                <label>Mot de passe : </label>
                <input name="password" type="password" placeholder="<password>">
                <button type="submit">valider</button>
                <p class = "error" > $sign</p>
                
            </form>
            </section>
            </div>
            
            
            <section class="synopsis">
                <h1>SYNOPSIS</h1>
                <p>Team Sonic Racing est un jeu de course en provenance de SEGA. Le titre reprend l'univers de son fameux hérisson et marque le retour de cette série de jeux dont le dernier opus date d'il y a six ans. Le jeu repose sur le concept de jeu en équipe où on ne sélectionne pas un seul pilote, mais une équipe de trois as du volant. </p>
            </section>
            
            <section class="synopsis">
                <h1>SYNOPSIS</h1>
                <p>Team Sonic Racing est un jeu de course en provenance de SEGA. Le titre reprend l'univers de son fameux hérisson et marque le retour de cette série de jeux dont le dernier opus date d'il y a six ans. Le jeu repose sur le concept de jeu en équipe où on ne sélectionne pas un seul pilote, mais une équipe de trois as du volant. </p>
            </section>
            <section class="synopsis">
                <h1>SYNOPSIS</h1>
                <p>Team Sonic Racing est un jeu de course en provenance de SEGA. Le titre reprend l'univers de son fameux hérisson et marque le retour de cette série de jeux dont le dernier opus date d'il y a six ans. Le jeu repose sur le concept de jeu en équipe où on ne sélectionne pas un seul pilote, mais une équipe de trois as du volant. </p>
            </section>
            <section class="synopsis">
                <h1>SYNOPSIS</h1>
                <p>Team Sonic Racing est un jeu de course en provenance de SEGA. Le titre reprend l'univers de son fameux hérisson et marque le retour de cette série de jeux dont le dernier opus date d'il y a six ans. Le jeu repose sur le concept de jeu en équipe où on ne sélectionne pas un seul pilote, mais une équipe de trois as du volant. </p>
            </section>
            END;
        }
        else {
            //ton espace
            $co = <<<END
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./../../style.css">
    <title>Accueil</title>
</head>
<body>
<header>
    <header class = "monpetitheader" id="pourreglersoucis">
            <h1 class = "titre_header">Court Circuit Nancy</h1>
            <a href="index.php?action=deconnexion" class = "deco">Déconnexion</a>
            <a href="index.php?action=DisplayCatalogueAction">Affichage du catalogue</a>
             
             $html
            

    </header>
</header>
END;

//            //mon espace
//            $stmt = new \ccd\action\DisplayCatalogue();
//            $str = $stmt->execute();
//            $co = $str;
        }
        echo <<<END
$co
</body>
</html>
END;
    }
}
