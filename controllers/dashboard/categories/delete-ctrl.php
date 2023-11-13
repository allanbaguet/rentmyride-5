<?php
require_once __DIR__ . '/../../../models/Category.php';

try {
    // Récupération du paramètre d'URL correspondant à l'id de la catégorie cliquée
    $id_categories = intval(filter_input(INPUT_GET, 'id_categories', FILTER_SANITIZE_NUMBER_INT));

    // Appel de la méthode deete
    $isOk = Category::delete($id_categories);

    // Si la méthode a retourné "true", alors on redirige vers la liste
    if ($isOk) {
        header('location: /controllers/dashboard/categories/list-ctrl.php');
        die;
    }
} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../../../views/dashboard/templates/header.php';
    include __DIR__ . '/../../../views/dashboard/templates/error.php';
    include __DIR__ . '/../../../views/dashboard/templates/footer.php';
    die;
}

