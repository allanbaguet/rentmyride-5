<?php
require_once __DIR__ .'/../../../config/init.php';
require_once __DIR__ .'/../../../models/Category.php';

try {
    if($_SESSION['client']->role != ADMIN){
        header('location: /controllers/clientsSignIn-ctrl.php');
        die;
    }


    // Appel de la méthode statique getAll
    $categories = Category::getAll();
} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../../../views/dashboard/templates/header.php';
    include __DIR__ . '/../../../views/dashboard/templates/error.php';
    include __DIR__ . '/../../../views/dashboard/templates/footer.php';
    die;
}
include __DIR__ .'/../../../views/dashboard/templates/header.php';
include __DIR__ .'/../../../views/dashboard/categories/list.php';
include __DIR__ .'/../../../views/dashboard/templates/footer.php';
