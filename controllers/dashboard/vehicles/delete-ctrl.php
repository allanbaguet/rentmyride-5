<?php
require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Vehicle.php';

try {
    // Récupération du paramètre d'URL correspondant à l'id de la catégorie cliquée
    $id_vehicles = intval(filter_input(INPUT_GET, 'id_vehicles', FILTER_SANITIZE_NUMBER_INT));

    $vehicle = Vehicle::get($id_vehicles);
    if ($vehicle) {
        // Appel de la méthode delete
        $isDeleted = Vehicle::delete($id_vehicles);
        if ($isDeleted) {
            FlashMessage::set('La suppression s\'est bien déroulée!', SUCCESS); 
        } else {
            FlashMessage::set('La suppression s\'est mal passée!', ERROR); 
        }

        // Suppression du visuel associé
        @unlink(__DIR__ . '/../../../public/uploads/vehicles/' . $vehicle->picture);
        // Si la méthode a retourné "true", alors on redirige vers la liste
    } else {
        FlashMessage::set('Le véhicule n\'existe pas!', ERROR); 
    }
    header('location: /controllers/dashboard/vehicles/list-ctrl.php');
    die;
} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../../../views/dashboard/templates/header.php';
    include __DIR__ . '/../../../views/dashboard/templates/error.php';
    include __DIR__ . '/../../../views/dashboard/templates/footer.php';
    die;
}
