<?php
require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Vehicle.php';

try {

    $id_categories = intval(filter_input(INPUT_GET, 'id_categories', FILTER_SANITIZE_NUMBER_INT));
    $id_categories = Category::get($id_categories)->id_categories ?? NULL;
    $search = trim((string) filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS));
    $page = intval(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT));

    // Nombre de résultats en fonction de la recherche
    $nbRows = Vehicle::count($id_categories, $search);
    // Calcul du nombre de pages
    $nbPages = ceil($nbRows / NB_RESULTS_PAGE);

    // Si $page vaut 0, alors, on l'initialise en première page.
    $page = ($page == 0) ? 1 : $page;

    // Appel de la méthode statique getAll permettant de récupérer toutes les catégories
    $categories = Category::getAll();

    // Appel de la méthode statique getAll permettant de récupérer tous les véhicules
    $column = is_null($id_categories) ? 'name' : 'brand';

    $vehicles = Vehicle::getAll(column: $column, id_categories: $id_categories, search: $search, page: $page);
    
} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../views/templates/header.php';
    include __DIR__ . '/../views/templates/error.php';
    include __DIR__ . '/../views/templates/footer.php';
    die;
}

include __DIR__ . '/../views/templates/header.php';
include __DIR__ . '/../views/vehicles/list.php';
include __DIR__ . '/../views/templates/footer.php';
