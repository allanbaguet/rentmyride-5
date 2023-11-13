<?php
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../models/Vehicle.php';

$search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);

$vehicles = Vehicle::getAll(search: $search);

echo json_encode($vehicles);