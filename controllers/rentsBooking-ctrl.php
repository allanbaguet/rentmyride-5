<?php
require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../models/Vehicle.php';
require_once __DIR__ . '/../models/Client.php';
require_once __DIR__ . '/../models/Rent.php';
require_once __DIR__ . '/../helpers/CheckDatas.php';


try {
    // Récupération du paramètre d'URL correspondant à l'id de la catégorie cliquée
    $id_vehicles = intval(filter_input(INPUT_GET, 'id_vehicles', FILTER_SANITIZE_NUMBER_INT));
    // Appel de la méthode statique getAll permettant de récupérer tous les véhicules
    $vehicle = Vehicle::get($id_vehicles);

    if ($_SERVER["REQUEST_METHOD"] == 'POST') {

        $datas = filter_input_array(INPUT_POST, [
            "lastname" => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ["regexp" => "/" . NAME . "/"]],
            "firstname" => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ["regexp" => "/" . NAME . "/"]],
            "email" => FILTER_VALIDATE_EMAIL,
            "birthday" => array('filter' => FILTER_VALIDATE_REGEXP, 'options' => ["regexp" => "/" . DATE . "/"]),
            "phone" => array('filter' => FILTER_VALIDATE_REGEXP, 'options' => ["regexp" => "/" . PHONE . "/"]),
            "zipcode" => array('filter' => FILTER_VALIDATE_REGEXP, 'options' => ["regexp" => "/" . ZIPCODE . "/"]),
            "city" => array(
                'filter' => FILTER_CALLBACK,
                'options' => function ($value){
                    $zipcode = filter_input(INPUT_POST, 'zipcode');
                    return CheckDatas::city($value, $zipcode);
                }
            ),
            "startdate" => array('filter' => FILTER_VALIDATE_REGEXP, 'options' => ["regexp" => "/" . DATE . "/"]),
            "enddate" => array('filter' => FILTER_VALIDATE_REGEXP, 'options' => ["regexp" => "/" . DATE . "/"])
        ]);

        $errors = CheckDatas::getErrors($datas);

        if(empty($errors)){
            try {
                $pdo = Database::connect();
                $pdo->beginTransaction();

                // Hydratation de l'objet client
                $client = new Client;
                $client->setLastname($datas["lastname"]);
                $client->setFirstname($datas["firstname"]);
                $client->setEmail($datas["email"]);
                $client->setBirthday($datas["birthday"]);
                $client->setPhone($datas["phone"]);
                $client->setCity($datas["city"]);
                $client->setZipcode($datas["zipcode"]);
                $isClientSaved = $client->insert();
                $id_clients = $pdo->lastInsertId();

                $rent = new rent;
                $rent->setStartdate($datas["startdate"]);
                $rent->setEnddate($datas["enddate"]);
                $rent->setId_vehicles($id_vehicles);
                $rent->setId_clients($id_clients);
                $isRentSaved = $rent->insert();
                
                if($isClientSaved && $isRentSaved){
                    $pdo->commit();
                    FlashMessage::set("Enregistrement effectué avec succés");
                } else {
                    throw new Exception("Erreur lors de l'enregistrement simultané");
                }

            } catch (\Throwable $th) {
                $pdo->rollback();
                FlashMessage::set($th->getMessage(), ERROR);
            }
        }


    }
} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../views/templates/header.php';
    include __DIR__ . '/../views/templates/error.php';
    include __DIR__ . '/../views/templates/footer.php';
    die;
}

include __DIR__ . '/../views/templates/header.php';
include __DIR__ . '/../views/rents/booking.php';
include __DIR__ . '/../views/templates/footer.php';
