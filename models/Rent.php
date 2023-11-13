<?php
require_once(__DIR__ . '/../helpers/connect.php');

class Rent{

    
    private int $id_rents;	
    private DateTime $startdate;	
    private DateTime $enddate;	
    private DateTime $created_at;	
    private ?DateTime $confirmed_at;	
    private ?int $id_vehicles;	
    private ?int $id_clients;	

    public function getId_rents(): int
    {
        return $this->id_rents;
    }

    public function setId_rents(int $id_rents)
    {
        $this->id_rents = $id_rents;
    }

    public function getStartdate(): DateTime
    {
        return $this->startdate;
    }

    public function setStartdate(string $startdate)
    {
        $this->startdate = new DateTime($startdate);
    }
    
    public function getEnddate(): DateTime
    {
        return $this->enddate;
    }

    public function setEnddate(string $enddate)
    {
        $this->enddate = new DateTime($enddate);
    }
    public function getCreated_at(): DateTime
    {
        return $this->created_at;
    }

    public function setCreated_at(string $created_at)
    {
        $this->created_at = new DateTime($created_at);
    }
    
    public function getConfirmed_at(): ?DateTime
    {
        return $this->confirmed_at;
    }

    public function setConfirmed_at(?string $confirmed_at)
    {
        $this->startdate = new DateTime($confirmed_at);
    }

    public function getId_vehicles(): ?int
    {
        return $this->id_vehicles;
    }

    public function setId_vehicles(?int $id_vehicles)
    {
        $this->id_vehicles = $id_vehicles;
    }

    public function getId_clients(): ?int
    {
        return $this->id_clients;
    }

    public function setId_clients(?int $id_clients)
    {
        $this->id_clients = $id_clients;
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
        $sql = 'INSERT INTO `rents` 
                    (`startdate`, `enddate`, `id_vehicles`, `id_clients`) 
                VALUES
                    (:startdate, :enddate, :id_vehicles, :id_clients);';

        // Si marqueur nominatif, il faut préparer la requête
        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':startdate', $this->getStartdate()->format('Y-m-d H:i:s'));
        $sth->bindValue(':enddate', $this->getEnddate()->format('Y-m-d H:i:s'));
        $sth->bindValue(':id_vehicles', $this->getId_vehicles());
        $sth->bindValue(':id_clients', $this->getId_clients());

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
     * Méthode permettant de récupérer la liste des réservation sous forme de tableau d'objets
     * @return array Tableau d'objets
     */
    public static function getAll(string $search = ''): array
    {
        $pdo = Database::connect();


        // Génération de la requête
        $sql = "SELECT * from `clients`
                INNER JOIN `rents` ON `clients`.`id_clients` = `rents`.`id_clients`
                INNER JOIN `vehicles` ON `vehicles`.`id_vehicles` = `rents`.`id_vehicles`
                WHERE 1 = 1";

        $sql .= " AND (
                    `clients`.`lastname` LIKE :search OR
                    `clients`.`phone` LIKE :search OR
                    `clients`.`city` LIKE :search
                    )";

        $sql .= " ORDER by `rents`.`startdate` DESC";

        $sth = $pdo->prepare($sql);
        $sth->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);

        $sth->execute();
        $datas = $sth->fetchAll();
        return $datas;
    }

}