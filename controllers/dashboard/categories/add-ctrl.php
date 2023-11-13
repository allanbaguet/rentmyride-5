<?php
require_once __DIR__ . '/../../../models/Category.php';

try {
    // Si les données du formulaire ont été transmises
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Récupération, nettoyage et validation des données
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!$name) {
            $error['name'] = 'Ce champ est obligatoire!';
        }

        $isExist = Category::isExist($name);
        if($isExist){
            $error['name'] = 'Cette catégorie existe déjà!';
        }

        // Enregistrement en base de données
        if (empty($error)) {
            // Création d'un nouvel objet issu de la classe 'category'
            $categoryObj = new Category();

            // Hydratation de notre objet
            $categoryObj->setName($name);

            // Appel de la méthode insert
            $isOk = $categoryObj->insert();

            // Si la méthode a retourné "true", alors on redirige vers la liste
            if($isOk){
                header('location: /controllers/dashboard/categories/list-ctrl.php');
                die;
            }
        }
    }
} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../../../views/dashboard/templates/header.php';
    include __DIR__ . '/../../../views/dashboard/templates/error.php';
    include __DIR__ . '/../../../views/dashboard/templates/footer.php';
    die;
}

include __DIR__ . '/../../../views/dashboard/templates/header.php';
include __DIR__ . '/../../../views/dashboard/categories/add.php';
include __DIR__ . '/../../../views/dashboard/templates/footer.php';