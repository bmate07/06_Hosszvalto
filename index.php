<?php

$mappa = "/projektek/06_MertekegysegValto";
//Útvonal (route) választó (router)

$parsed = parse_url($_SERVER['REQUEST_URI']);
//var_dump($parsed);
$path = $parsed['path'];

//útvonal választó (valuta)
switch ($path) {
    case $mappa . "/":

        require('./view/home.php');
        break;
    case $mappa . "/valutavalto":
        $mennyit = (int) ($_GET['mennyit'] ?? 1);
        $mirol = $_GET['mirol'] ?? "USD";
        $mire = $_GET['mire'] ?? 'HUF';

        $url = "http://localhost:3000/currencies/$mirol";
        $atvaltoTablazat = json_decode(file_get_contents($url), true);
        $url = "http://localhost:3000/currencies";
        $valutak = json_decode(file_get_contents($url), true);
        $vegeredmeny = $mennyit * $atvaltoTablazat['rates'][$mire];

        require('./view/valutavalto.php');
        break;

    case $mappa . "/hosszvalto":
        $mennyit = (int) ($_GET['mennyit'] ?? 1);
        $mirol = $_GET['mirol'] ?? "mm";
        $mire = $_GET['mire'] ?? 'm';

        $url = "http://localhost:3000/mertekegysegek/$mirol";
        $atvaltoTablazat = json_decode(file_get_contents($url), true);
        $url = "http://localhost:3000/mertekegysegek";
        $hosszusag = json_decode(file_get_contents($url), true);
        $vegeredmeny = $mennyit * $atvaltoTablazat['rates'][$mire];

        require('./view/hosszvalto.php');
        break;

    default:
        require('./view/404.php');
        break;
}
?>