<?php


//********************************************************** */
//Appel de toutes les requetes SQL & nommage des fonctions
//********************************************************** */

// Page Read.php
$sqlQuery = '
SELECT f.id, f.nom, f.licence,f.description, f.date_ajout, v.prix_estime, v.etat
FROM figurines f
LEFT JOIN valeur v ON f.id = v.figurine_id
ORDER BY `f`.`date_ajout`
DESC;';

$lastFigurines = $mysqlClient->prepare($sqlQuery);
$lastFigurines->execute();
$figurines = $lastFigurines->fetchAll();


// Page Create_post.php

//Page submit-login.php
$sqlQuerySell = 'SELECT * FROM `vendeurs`';
$sellBdd = $mysqlClient->prepare($sqlQuerySell);
$sellBdd->execute();
$sellers = $sellBdd->fetchAll();


//Redirection de page
function redirectToUrl(string $url): never
{

    header("Location: {$url}");

    exit();
}
