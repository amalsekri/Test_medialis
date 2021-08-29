<?php

namespace Controllers;

class BaseController{
    public function rendu($vue, array $parametresVue = []){
        extract($parametresVue);
        ob_start();             /* Pour commencer à mettre l'affichage en mémoire tampon (buffering)
        c'est-à-dire que l'affichage n'est pas généré tout de suite mais
        il est mis en attente, jusqu'à ce que j'arrête d'utiliser la mémoire
        tampon */
        include "vues/" . $vue;
        $contenu = ob_get_contents(); // on récupère tout ce qui est en mémoire tampon
        ob_end_clean();  // Arrête et vide la mémoire tampon
        include_once "vues/base.html.php";        
    }

}