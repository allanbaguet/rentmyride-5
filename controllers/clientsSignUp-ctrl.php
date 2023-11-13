<?php
require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../models/Client.php';
require_once __DIR__ . '/../helpers/CheckDatas.php';
require_once __DIR__ . '/../helpers/JWT.php';

try {
   
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
            "password" => FILTER_DEFAULT,
            "passwordConfirm" => FILTER_DEFAULT,
        ]);

        $errors = CheckDatas::getErrors($datas);

        if($datas['password'] !== $datas['passwordConfirm']){
            $errors['password'] = 'Les 2 mots de passe sont différents!!';
        }

        if(empty($errors)){
            try {
          
                $pdo = Database::connect();
                // Hydratation de l'objet client
                $client = new Client;
                $client->setLastname($datas["lastname"]);
                $client->setFirstname($datas["firstname"]);
                $client->setEmail($datas["email"]);
                $client->setPassword($datas["password"]);
                $client->setBirthday($datas["birthday"]);
                $client->setPhone($datas["phone"]);
                $client->setCity($datas["city"]);
                $client->setZipcode($datas["zipcode"]);
                $isClientSaved = $client->insert();
                $id_clients = $pdo->lastInsertId();
                
                if($isClientSaved){
                    //envoi de mail
                    $payload = (object) ['id_clients' => $id_clients];

                    $jwt = JWT::create($payload);
                    $to = $datas["email"];
                    $subject = 'Confirmation de votre inscription!';
                    $link = HOST.'/controllers/clientsConfirmSignUp-ctrl.php?jwt='.$jwt;
                    $message = '
                                <p>
                                Veuillez cliquer sur ce lien pour valider votre inscription.<br>
                                <a href="'.$link.'">Confirmation</a>
                                </p>';
                    mail($to, $subject, $message);
                    FlashMessage::set("Votre inscription est prise en compte. veuillez vérifier vos emails");
                } else {
                    throw new Exception("Erreur lors de votre inscription:");
                }

            } catch (\Throwable $th) {
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
include __DIR__ . '/../views/clients/signUp.php';
include __DIR__ . '/../views/templates/footer.php';
