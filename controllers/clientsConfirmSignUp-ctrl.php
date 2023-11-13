<?php
require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../helpers/JWT.php';
require_once __DIR__ . '/../models/Client.php';

try {
    $jwt = filter_input(INPUT_GET, 'jwt');
    
    $payload = JWT::get($jwt);
    
    if(!$payload){
        throw new Exception("Lien non valide ou expiré!", 1);
    }
    $id_clients = $payload->id_clients;
    
    $client = Client::get($id_clients);
    if (!$client) {
        throw new Exception("Ce compte n'existe pas", 1);
    }
    if (!is_null($client->confirmed_at)) {
        throw new Exception("Vous avez déjà confirmé votre inscription", 2);
    }

    $isConfirmed = Client::confirmSignUp($id_clients);
    if(!$isConfirmed){
        throw new Exception("Problème lors de la validation de votre inscription", 3);
    }
    FlashMessage::set("Votre inscription est confirmée" , SUCCESS);

} catch (\Throwable $th) {
    FlashMessage::set($th->getMessage(), ERROR);
}



include __DIR__ . '/../views/templates/header.php';
include __DIR__ . '/../views/clients/confirmSignUp.php';
include __DIR__ . '/../views/templates/footer.php';