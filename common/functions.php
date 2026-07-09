<?php


//********************************************************** */
//Appel de toutes les requetes SQL & nommage des fonctions
//********************************************************** */
// Page acceuil.php
$sqlQuery = '
SELECT f.id, f.nom, f.licence,f.description, f.date_ajout, v.prix_estime, v.etat
FROM figurines f
LEFT JOIN valeur v ON f.id = v.figurine_id
ORDER BY `f`.`date_ajout`
DESC
LIMIT 3';

$lastFigurines = $mysqlClient->prepare($sqlQuery);
$lastFigurines->execute();
$figurines = $lastFigurines->fetchAll();


//********************************* */
//Page submit-login.php
//********************************* */
$sqlQueryAdm = 'SELECT * FROM `admins`';
$admBdd = $mysqlClient->prepare($sqlQueryAdm);
$admBdd->execute();
$admins = $admBdd->fetchAll();





//********************************* */
//Tronquer un texte
//********************************* */
function truncateString($string, $length = 20)
{
    // strlen() : compte le nombre de caractères
    if (strlen($string) > $length) {
        // substr() : extrait une partie de la chaîne (de 0 à $length)
        return substr($string, 0, $length) . ' (...)';
    }
    // Si le texte est assez court, on le retourne tel quel
    return $string;
}



//********************************* */
//Redirection de page
//********************************* */
function redirectToUrl(string $url): never
{

    header("Location: {$url}");

    exit();
}



//********************************* */
// Slugify de l'url
//********************************* */
function slugify($text)
{
    // Étape 1 : Remplace tous les caractères non alphanumériques par un tiret
    // \pL = lettres Unicode (pour gérer les accents)
    // \d = chiffres
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // Étape 2 : Translitération (convertit les caractères accentués en ASCII)
    // é devient e, à devient a, etc.
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // Étape 3 : Supprime les caractères indésirables qui restent
    // On garde uniquement les tirets et les caractères alphanumériques
    $text = preg_replace('~[^-\w]+~', '', $text);

    // Étape 4 : Supprime les tirets en début et fin de chaîne
    $text = trim($text, '-');

    // Étape 5 : Convertit tout en minuscules pour uniformiser
    $text = strtolower($text);

    // Si après tout ça le texte est vide, on retourne 'n-a' (non applicable)
    return empty($text) ? 'n-a' : $text;
}
