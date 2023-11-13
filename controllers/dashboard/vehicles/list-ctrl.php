<?php
require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Vehicle.php';


try {
    $column = filter_input(INPUT_GET, 'column', FILTER_SANITIZE_SPECIAL_CHARS);
    $order = filter_input(INPUT_GET, 'order', FILTER_SANITIZE_SPECIAL_CHARS);
    
    $order = ($order != 'DESC' && $order != 'ASC') ? 'ASC': $order; 
    $column = (!in_array($column, COLUMNS)) ? 'name' : $column; 
    
    // Appel de la méthode statique getAll
    $vehicles = Vehicle::getAll($column, $order);

} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../../../views/dashboard/templates/header.php';
    include __DIR__ . '/../../../views/dashboard/templates/error.php';
    include __DIR__ . '/../../../views/dashboard/templates/footer.php';
    die;
}
include __DIR__ . '/../../../views/dashboard/templates/header.php';
include __DIR__ . '/../../../views/dashboard/vehicles/list.php';
include __DIR__ . '/../../../views/dashboard/templates/footer.php';
