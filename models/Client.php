<?php
require_once(__DIR__ . '/../helpers/connect.php');

class Client
{

    private int $id_rents;
    private string $lastname;
    private string $firstname;
    private string $email;
    private string $password;
    private DateTime $birthday;
    private string $phone;
    private string $city;
    private string $zipcode;
    private DateTime $created_at;
    private DateTime $updated_at;

    public function getId_rents(): int
    {
        return $this->id_rents;
    }

    public function setId_rents(int $id_rents)
    {
        $this->id_rents = $id_rents;
    }


    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(string $birthday)
    {
        $this->birthday = new DateTime($birthday);
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city)
    {
        $this->city = $city;
    }

    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode)
    {
        $this->zipcode = $zipcode;
    }

    public function getCreated_at(): DateTime
    {
        return $this->created_at;
    }

    public function setCreated_at(string $created_at)
    {
        $this->created_at = new DateTime($created_at);
    }

    public function getUpdated_at(): DateTime
    {
        return $this->updated_at;
    }

    public function setUpdated_at(string $updated_at)
    {
        $this->updated_at = new DateTime($updated_at);
    }


    /**
     * Méthode permettant l'enregistrement d'une nouvelle réservation
     * 
     * @return bool True en cas de succès, sinon une erreur de type Exception est générée
     */
    public function insert(): bool
    {
        // Création d'une variable recevant un objet issu de la classe PDO 
        $pdo = Database::connect();

        // Requête contenant des marqueurs nominatifs
        $sql = 'INSERT INTO `clients` 
                    (`lastname`, `firstname`, `email`, `password`, `birthday`, `phone`, `city`, `zipcode`) 
                VALUES
                    (:lastname, :firstname, :email, :password, :birthday, :phone, :city, :zipcode);';

        // Si marqueur nominatif, il faut préparer la requête
        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':lastname', $this->getLastname());
        $sth->bindValue(':firstname', $this->getFirstname());
        $sth->bindValue(':email', $this->getEmail());
        $sth->bindValue(':password', $this->getPassword());
        $sth->bindValue(':birthday', $this->getBirthday()->format('Y-m-d H:i:s'));
        $sth->bindValue(':phone', $this->getPhone());
        $sth->bindValue(':city', $this->getCity());
        $sth->bindValue(':zipcode', $this->getZipcode());

        // Exécution de la requête
        $sth->execute();

        // Appel à la méthode rowCount permettant de savoir combien d'enregistrements ont été affectés
        // par la dernière requête (fonctionnel uniquement sur insert, update, ou delete. PAS SUR SELECT!!)
        if ($sth->rowCount() <= 0) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            return false;
        } else {
            // Retourne true dans le cas contraire (tout s'est bien passé)
            return true;
        }
    }

        /**
     * Méthode permettant  de récupérer un objet standard avec pour propriétés, les colonnes sélectionnées
     * 
     * @param int $id id de l'enregistrement à récupérer
     * 
     * @return object
     */
    public static function get(int $id): object|false
    {
        $pdo = Database::connect();
        $sql = 'SELECT * from `clients` WHERE `id_clients` = :id_clients';

        // Si marqueur nominatif, il faut préparer la requête
        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':id_clients', $id);

        // Exécution de la requête
        $sth->execute();
        $data = $sth->fetch();
        // On teste si data est vide.
        if (!$data) {
            return false;
        } else {
            // Retourne la donnée complète sous forme d'objet (tout s'est bien passé)
            return $data;
        }
    }

    
        /**
     * Méthode permettant  de récupérer un objet standard avec pour propriétés, les colonnes sélectionnées
     * 
     * @param string $email email de l'enregistrement à récupérer
     * 
     * @return object
     */
    public static function getByEmail(string $email): object|false
    {
        $pdo = Database::connect();
        $sql = 'SELECT * from `clients` WHERE `email` = :email';

        // Si marqueur nominatif, il faut préparer la requête
        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':email', $email);

        // Exécution de la requête
        $sth->execute();
        $data = $sth->fetch();
        // On teste si data est vide.
        if (!$data) {
            return false;
        } else {
            // Retourne la donnée complète sous forme d'objet (tout s'est bien passé)
            return $data;
        }
    }

    public static function confirmSignUp(int $id_clients): bool {

        $pdo = Database::connect();
        $sql = 'UPDATE `clients` SET `confirmed_at` = NOW() WHERE `clients`.`id_clients` = :id_clients;';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id_clients', $id_clients, PDO::PARAM_INT);
        $sth->execute();
        if($sth->rowCount()<=0){
            return false;
        } else {
            return true;
        }
    }

    // UPDATE `clients` SET `confirmed_at` = '2023-10-25 11:11:46' WHERE `clients`.`id_clients` = 1;

}
