<?php

function dump($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
}

function dd($variable){
    // Dump and die
    dump($variable);
    exit;
}


