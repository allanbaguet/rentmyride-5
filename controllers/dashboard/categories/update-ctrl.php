<?php
require_once __DIR__ . '/../../../models/Category.php';

try {
    // Récupération du paramètre d'URL correspondant à l'id de la catégorie cliquée
    $id_categories = intval(filter_input(INPUT_GET, 'id_categories', FILTER_SANITIZE_NUMBER_INT));

    // Si les données du formulaire ont été transmises
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // Récupération, nettoyage et validation des données
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!$name) {
            $error['name'] = 'Ce champ est obligatoire!';
        }

        // Enregistrement en base de données
        if (empty($error)) {
            // Création d'un nouvel objet issu de la classe 'Type'
            $categoryObj = new Category();

            // Hydratation de notre objet
            $categoryObj->setId_categories($id_categories);
            $categoryObj->setName($name);
            
            // Appel de la méthode update
            $isOk = $categoryObj->update();
            
            // Si la méthode a retourné "true", alors on redirige vers la liste
            if($isOk){
                $message = 'Catégorie modifiée avec succés';
            }
        }
    }

    // Récupération de la catégorie selon son id
    $category = Category::get($id_categories);

} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../../../views/dashboard/templates/header.php';
    include __DIR__ . '/../../../views/dashboard/templates/error.php';
    include __DIR__ . '/../../../views/dashboard/templates/footer.php';
    die;
}

include __DIR__ . '/../../../views/dashboard/templates/header.php';
include __DIR__ . '/../../../views/dashboard/categories/update.php';
include __DIR__ . '/../../../views/dashboard/templates/footer.php';