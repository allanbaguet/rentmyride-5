<?php

// C'est le DSN : Data Source Name qui contient des informations sur la base de données
define('DSN', 'mysql:host=localhost;dbname=dwwm_rentmyride');
// Ne pas utiliser le login root. Il faut personnaliser les privilèges avec un nom d'utilisateur et un mot de passe spécifique
define('LOGIN', 'root');
define('PASSWORD', '');

define('COLUMNS', ['name', 'brand', 'model', 'mileage']);
define('FORMAT_IMAGE', ["image/jpeg"]);
define('MAX_FILESIZE', 5 * 1024 * 1024);
define('NB_RESULTS_PAGE', 10);

define('ERROR', 0);
define('SUCCESS', 1);

define ('HOST', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']);

define('ADMIN', 1);
define('SECRET_KEY', 'jfdshksd544-_543fsdFSFSQ');

define('TIME_TO_EXPIRE', 20 * 60);
