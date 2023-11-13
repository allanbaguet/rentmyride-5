<?php

require_once __DIR__ . '/../config/init.php';

unset($_SESSION['client']);
session_regenerate_id();

header('location: /');
die;
