<?php
require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/rent.php';


try {  
    // Appel de la méthode statique getAll
    $rents = Rent::getAll();

} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../../../views/dashboard/templates/header.php';
    include __DIR__ . '/../../../views/dashboard/templates/error.php';
    include __DIR__ . '/../../../views/dashboard/templates/footer.php';
    die;
}
include __DIR__ . '/../../../views/dashboard/templates/header.php';
include __DIR__ . '/../../../views/dashboard/rents/list.php';
include __DIR__ . '/../../../views/dashboard/templates/footer.php';
