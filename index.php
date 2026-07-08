<?php
require "connexion.php";

$auteur = $_GET["auteur"] ?? null;

if ($auteur !== null) {
    $auteur = htmlspecialchars(trim($auteur));
    $stmt = $pdo->prepare(
        "SELECT * FROM articles WHERE auteur = ? ORDER BY date_publication DESC",
    );
    $stmt->execute([$auteur]);
} else {
    $stmt = $pdo->query(
        "SELECT * FROM articles ORDER BY date_publication DESC",
    );
}

$articles = $stmt->fetchAll();
?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1 class="mb-4">Mon Blog</h1>

<?php foreach ($articles as $article): ?>
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h2 class="card-title">
                <?= htmlspecialchars($article["titre"]) ?>
            </h2>
            <p class="text-muted">
                Par <?= htmlspecialchars($article["auteur"]) ?>
                — le <?= $article["date_publication"] ?>
            <p class="card-text">
                <?= htmlspecialchars(substr($article["contenu"], 0, 200)) ?>...
            </p>
            <a href="article.php?id=<?= $article["id"] ?>"
               class="btn btn-primary btn-sm">Lire la suite</a>
        </div>
    </div>
<?php endforeach; ?>

</div>
</body>
</html>


