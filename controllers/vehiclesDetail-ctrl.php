<?php
require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../models/Vehicle.php';

try {
    // Récupération du paramètre d'URL correspondant à l'id de la catégorie cliquée
    $id_vehicles = intval(filter_input(INPUT_GET, 'id_vehicles', FILTER_SANITIZE_NUMBER_INT));
    // Appel de la méthode statique getAll permettant de récupérer tous les véhicules
    $vehicle = Vehicle::get($id_vehicles);
} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../views/templates/header.php';
    include __DIR__ . '/../views/templates/error.php';
    include __DIR__ . '/../views/templates/footer.php';
    die;
}

include __DIR__ . '/../views/templates/header.php';
include __DIR__ . '/../views/vehicles/detail.php';
include __DIR__ . '/../views/templates/footer.php';
