<?php
require "connexion.php";

// 1. Récupérer l'id dans l'URL ($_GET) et le convertir en entier
//    intval() garantit que c'est bien un nombre entier (sécurité)
$id = intval($_GET["id"] ?? 0);

// 2. Si l'id est invalide (0 ou négatif), on redirige vers l'accueil
if ($id <= 0) {
    header("Location: index.php");
    exit();
}

// 3. Requête préparée : le ? sera remplacé par $id de façon sécurisée
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);

// 4. On récupère UN SEUL résultat
$article = $stmt->fetch();

// 5. Si aucun article trouvé avec cet id, on redirige
if (!$article) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($article["titre"]) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5" style="max-width: 760px">

    <a href="index.php" class="btn btn-outline-secondary btn-sm mb-4">
        ← Retour aux articles
    </a>

    <article>
        <h1><?= htmlspecialchars($article["titre"]) ?></h1>
        <p class="text-muted">
            Par <?= htmlspecialchars($article["auteur"]) ?>
            — le <?= $article["date_publication"] ?>
        </p>
        <hr>
        <p><?= nl2br(htmlspecialchars($article["contenu"])) ?></p>
    </article>

</div>
</body>
</html>


