<?php
require_once __DIR__ . '/../../../helpers/dd.php';
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/regexp.php';
require_once __DIR__ . '/../../../models/Category.php';
require_once __DIR__ . '/../../../models/Vehicle.php';

try {
    $categories = Category::getAll();
    // Si les données du formulaire ont été transmises
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Récupération, nettoyage et validation des données
        $id_categories = intval(filter_input(INPUT_POST, 'id_categories', FILTER_SANITIZE_NUMBER_INT));
        $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_SPECIAL_CHARS);
        $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_SPECIAL_CHARS);
        $registration = filter_input(INPUT_POST, 'registration', FILTER_SANITIZE_SPECIAL_CHARS);
        $mileage = intval(filter_input(INPUT_POST, 'mileage', FILTER_SANITIZE_NUMBER_INT));
        $picture = $_FILES['picture'];

        if (!$id_categories) {
            $error['id_categories'] = 'Ce champ est obligatoire!';
        } else {
            if (!Category::get($id_categories)) {
                $error['id_categories'] = 'Cette catégorie est inconnue!';
            }
        }

        if (!$brand) {
            $error['brand'] = 'Ce champ est obligatoire!';
        } else {
            $isOk = filter_var($brand, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/" . NAME . "/")));
            if (!$isOk) {
                $error['brand'] = 'Cette valeur n\'est pas correcte';
            }
        }

        if (!$model) {
            $error['model'] = 'Ce champ est obligatoire!';
        } else {
            $isOk = filter_var($brand, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/" . NAME . "/")));
            if (!$isOk) {
                $error['brand'] = 'Cette valeur n\'est pas correcte';
            }
        }

        if (!$registration) {
            $error['registration'] = 'Ce champ est obligatoire!';
        } else {
            $isOk = filter_var($registration, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/" . REGISTRATION . "/")));
            if (!$isOk) {
                $error['registration'] = 'Cette valeur n\'est pas correcte';
            }
        }

        if ($mileage){
            $isOk = $mileage >= 0;
            if (!$isOk) {
                $error['mileage'] = 'Cette valeur n\'est pas correcte';
            }
        }

        // Enregistrement du fichier localement sur le serveur
        $filename = NULL;
        if ($picture['error'] != 4) {
            try {
                if ($picture['error'] != 0) {
                    throw new Exception("Erreur lors du transfert");
                }

                if (!in_array($picture['type'], FORMAT_IMAGE)) {
                    throw new Exception("Format de fichier non autorisé");
                }

                if ($picture['size'] >= MAX_FILESIZE) {
                    throw new Exception("Poids dépassé!");
                }
                $extension = pathinfo($picture["name"], PATHINFO_EXTENSION);
                $filename = uniqid().'.'.$extension;
                $from = $picture["tmp_name"];
                $to = __DIR__.'/../../../public/uploads/vehicles/'.$filename;
                move_uploaded_file($from, $to);
            } catch (\Throwable $th) {
                $error['picture'] = $th->getMessage();
            }
        }

        // Enregistrement en base de données
        if (empty($error)) {
            // Création d'un nouvel objet issu de la classe 'Vehicle'
            $vehicleObj = new Vehicle();
            // Hydratation de notre objet
            $vehicleObj->setId_categories($id_categories);
            $vehicleObj->setBrand($brand);
            $vehicleObj->setModel($model);
            $vehicleObj->setRegistration($registration);
            $vehicleObj->setMileage($mileage);
            $vehicleObj->setPicture($filename);

            // Appel de la méthode insert
            $isOk = $vehicleObj->insert();

            // Si la méthode a retourné "true", alors on redirige vers la liste
            if ($isOk) {
                header('location: /controllers/dashboard/vehicles/list-ctrl.php');
                die;
            }
        }
    }
} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../../../views/dashboard/templates/header.php';
    include __DIR__ . '/../../../views/dashboard/templates/error.php';
    include __DIR__ . '/../../../views/dashboard/templates/footer.php';
    die;
}

include __DIR__ . '/../../../views/dashboard/templates/header.php';
include __DIR__ . '/../../../views/dashboard/vehicles/add.php';
include __DIR__ . '/../../../views/dashboard/templates/footer.php';
