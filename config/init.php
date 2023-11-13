<?php
session_start();
require_once __DIR__ . '/../helpers/dd.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/regexp.php';
require_once __DIR__ . '/../helpers/FlashMessage.php';
require_once __DIR__ . '/../models/Category.php';

// Appel de la méthode statique getAll permettant de récupérer toutes les catégories
$categories = Category::getAll();
