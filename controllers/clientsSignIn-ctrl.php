<?php
require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../models/Client.php';
require_once __DIR__ . '/../helpers/CheckDatas.php';

try {
   
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {

        $datas = filter_input_array(INPUT_POST, [
            "email" => FILTER_SANITIZE_EMAIL,
            "password" => FILTER_DEFAULT
        ]);

        $errors = CheckDatas::getErrors($datas);

        if(empty($errors)){
            $client = Client::getByEmail($datas["email"]);
            try {
                if(!$client){
                    throw new Exception("Echec d'authentification", 1); 
                }
                $isOk = password_verify($datas["password"], $client->password);

                if(!$isOk){
                    throw new Exception("Echec d'authentification", 2); 
                }

                if(is_null($client->confirmed_at)){
                    throw new Exception("Vous n'avez pas encore validé votre inscription", 2); 
                }

                unset($client->password);
                $_SESSION['client'] = $client;
                header('location: /');
                die;

            } catch (\Throwable $th) {
                $errors["email"] = $th->getMessage();
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
include __DIR__ . '/../views/clients/signIn.php';
include __DIR__ . '/../views/templates/footer.php';
