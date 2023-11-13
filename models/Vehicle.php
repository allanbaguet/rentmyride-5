<?php
require_once(__DIR__ . '/../helpers/dd.php');

require_once(__DIR__ . '/../helpers/connect.php');

class Vehicle
{
    private int $id_vehicles;
    private string $brand;
    private string $model;
    private string $registration;
    private int $mileage;
    private ?string $picture = NULL;
    private DateTime $created_at;
    private DateTime $updated_at;
    private DateTime $deleted_at;
    private int $id_categories;

    public function getId_vehicles(): int
    {
        return $this->id_vehicles;
    }

    public function setId_vehicles(int $id_vehicles)
    {
        $this->id_vehicles = $id_vehicles;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand)
    {
        $this->brand = $brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model)
    {
        $this->model = $model;
    }

    public function getRegistration(): string
    {
        return $this->registration;
    }

    public function setRegistration(string $registration)
    {
        $this->registration = $registration;
    }

    public function getMileage(): int
    {
        return $this->mileage;
    }

    public function setMileage(int $mileage)
    {
        $this->mileage = $mileage;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture = NULL)
    {
        $this->picture = $picture;
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

    public function getDeleted_at(): DateTime
    {
        return $this->deleted_at;
    }

    public function setDeleted_at(string $deleted_at)
    {
        $this->deleted_at = new DateTime($deleted_at);
    }

    public function getId_categories(): int
    {
        return $this->id_categories;
    }

    public function setId_categories(int $id_categories)
    {
        $this->id_categories = $id_categories;
    }

    /**
     * Méthode permettant l'enregistrement d'un nouveau véhicule
     * 
     * @return bool True en cas de succès, sinon une erreur de type Exception est générée
     */
    public function insert(): bool
    {
        // Création d'une variable recevant un objet issu de la classe PDO 
        $pdo = Database::connect();

        // Requête contenant un marqueur nominatif
        $sql = 'INSERT INTO `vehicles` 
                    (`brand`, `model`, `registration`, `mileage`, `picture`, `id_categories`) 
                VALUES
                    (:brand, :model, :registration, :mileage, :picture, :id_categories);';

        // Si marqueur nominatif, il faut préparer la requête
        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':brand', $this->getBrand());
        $sth->bindValue(':model', $this->getModel());
        $sth->bindValue(':registration', $this->getRegistration());
        $sth->bindValue(':mileage', $this->getMileage());
        $sth->bindValue(':picture', $this->getPicture());
        $sth->bindValue(':id_categories', $this->getId_categories());

        // Exécution de la requête
        $sth->execute();

        // Appel aà la méthode rowCount permettant de savoir combien d'enregistrements ont été affectés
        // par la dernière requête (fonctionnel uniquement sur insert, update, ou delete. PAS SUR SELECT!!)
        if ($sth->rowCount() <= 0) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            throw new Exception('Erreur lors de l\'enregistrement de la catégorie');
        } else {
            // Retourne true dans le cas contraire (tout s'est bien passé)
            return true;
        }
    }

    public static function count(int $id_categories = NULL, string $search = ''): int
    {
        $pdo = Database::connect();
        $sql = "SELECT count(*) as `count` from `vehicles`
                INNER JOIN `categories` ON `vehicles`.`id_categories` = `categories`.`id_categories`
                WHERE 1 = 1";

        $sql .= " AND (
                    `categories`.`name` LIKE :search OR
                    `vehicles`.`model` LIKE :search OR
                    `vehicles`.`brand` LIKE :search
                    )";

        if (!is_null($id_categories)) {
            $sql .= " AND `categories`.`id_categories` = :id_categories";
        }
        $sql .= ";";

        $sth = $pdo->prepare($sql);
        $sth->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        if (!is_null($id_categories)) {
            $sth->bindValue(':id_categories', $id_categories, PDO::PARAM_INT);
        }
        $sth->execute();
        $result = $sth->fetchColumn();
        return $result;
    }

    /**
     * Méthode permettant de récupérer la liste des véhicules sous forme de tableau d'objets
     * @return array Tableau d'objets
     */
    public static function getAll(string $column = 'name', string $order = 'ASC', int $id_categories = NULL, string $search = '', int $page = 1): array
    {
        $pdo = Database::connect();

        $table = ($column == 'name') ? 'categories' : 'vehicles';
        
        // Calcul de l'offset
        $offset =  ($page - 1) * NB_RESULTS_PAGE;

        // Génération de la requête
        $sql = "SELECT * from `vehicles`
                INNER JOIN `categories` ON `vehicles`.`id_categories` = `categories`.`id_categories`
                WHERE 1 = 1";

        $sql .= " AND (
                    `categories`.`name` LIKE :search OR
                    `vehicles`.`model` LIKE :search OR
                    `vehicles`.`brand` LIKE :search
                    )";

        if (!is_null($id_categories)) {
            $sql .= " AND `categories`.`id_categories` = :id_categories";
        }

        $sql .= " ORDER by `$table`.`$column` $order";

        $sql .= " LIMIT $offset, " . NB_RESULTS_PAGE . ";";
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);

        if (!is_null($id_categories)) {
            $sth->bindValue(':id_categories', $id_categories, PDO::PARAM_INT);
        }
        $sth->execute();
        $datas = $sth->fetchAll();
        return $datas;
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
        $sql = 'SELECT * FROM `vehicles`
                INNER JOIN `categories` ON `categories`.`id_categories` = `vehicles`.`id_categories`
                WHERE `id_vehicles` = :id_vehicles';

        // Si marqueur nominatif, il faut préparer la requête
        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':id_vehicles', $id);

        // Exécution de la requête
        $sth->execute();
        $data = $sth->fetch();
        // On teste si data est vide.
        if (!$data) {
            return false;
        } else {
            // Retourne true dans le cas contraire (tout s'est bien passé)
            return $data;
        }
    }


    /**
     * Méthode permettant l'enregistrement la mise à jour d'une catégorie
     * 
     * @return bool True en cas de succès, sinon une erreur de type Exception est générée
     */
    public function update(): bool
    {
        // Création d'une variable recevant un objet issu de la classe PDO 
        $pdo = Database::connect();

        // Requête contenant un marqueur nominatif
        $sql = 'UPDATE `vehicles` SET 
                    `brand` = :brand,
                    `model` = :model,
                    `registration` = :registration,
                    `mileage` = :mileage,
                    `picture` = :picture,
                    `id_categories` = :id_categories
                    
                     WHERE `id_vehicles` = :id_vehicles;';

        // Si marqueur nominatif, il faut préparer la requête
        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':brand', $this->getBrand());
        $sth->bindValue(':model', $this->getModel());
        $sth->bindValue(':registration', $this->getRegistration());
        $sth->bindValue(':mileage', $this->getMileage());
        $sth->bindValue(':picture', $this->getPicture());
        $sth->bindValue(':id_categories', $this->getId_categories());
        $sth->bindValue(':id_vehicles', $this->getId_vehicles());

        // Appel aà la méthode rowCount permettant de savoir combien d'enregistrements ont été affectés
        // par la dernière requête (fonctionnel uniquement sur insert, update, ou delete. PAS SUR SELECT!!)
        if (!$sth->execute()) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            throw new Exception('Erreur lors de la mise à jour de la catégorie');
        } else {
            // Retourne true dans le cas contraire (tout s'est bien passé)
            return true;
        }
    }

    /**
     * Méthode permettant la suppression d'une catégorie
     * 
     * @return bool True en cas de succès, sinon une erreur de type Exception est générée
     */
    public static function delete($id): bool
    {
        $pdo = Database::connect();
        $sql = 'UPDATE `vehicles` SET 
                    `deleted_at` = NOW() WHERE `id_vehicles` = :id_vehicles;';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id_vehicles', $id, PDO::PARAM_INT);
        $sth->execute();
        if ($sth->rowCount() <= 0) {
            return false;
        } else {
            return true;
        }
    }
}
