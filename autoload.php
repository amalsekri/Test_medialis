<?php

function chargerClasse($classe){
    /* str_replace($search, $replace, $str) : le string $search est remplacé par $replace dans la string $str */
    $classe = str_replace("\\", "/", $classe);
    include $classe . ".php";
}

/* spl_autoload_register : le paramètre passé est le nom de la fonction qui sera déclenché à chaque fois
                            qu'un objet sera instancié (par exemple : $obj = new Classe;)
*/
spl_autoload_register("chargerClasse");