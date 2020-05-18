<?php
namespace App\Core;
use App\Core\Model;

class DB
{
    private $table;
    private $pdo;
    private static $_instance;

    // SINGLETON
    public function __construct()
    {
        try {
            $this->pdo = new PDO(DRIVER_DB.":host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PWD_DB);
        } catch (Exception $e) {
            die('Erreur SQL' . $e->getMessage());
        }

        $this->table = PREFIXE_DB . get_called_class();
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance)){

        }
    }

    /**
     * Permet d'effectuer une requête PDO vers la base de données
     * @param $request la requête à effectuer
     * @param null $parameters les paramètres de la requête
     * @return mixed
     */
    protected function sql($request, $parameters = null)
    {
        if ($parameters) {
            $queryPrepared = $this->pdo->prepare($request);
            $queryPrepared->execute($parameters);
            return $queryPrepared;
        } else {
            $queryPrepared = $this->pdo->prepare($request);
            $queryPrepared->execute();
            return $queryPrepared;
        }
    }

    /**
     * Récupère un élément de l'objet courant en base de données.
     * @param int $id
     * @return l'objet courant avec les données remplies
     */
    public function find(int $id): ?Model {
        $request = "SELECT * FROM $this->table WHERE id = :id";

        $result = $this->sql($request, [':id' => $id]);
        $row = $result->fetch();

        if ($row) {
            $object = new $this->class();
            return $object->hydrate($row);
        } else {
            return null;
        }
    }

    public function findBy(array $params, array $order = null): array {
        $results = array();
        $request = 'SELECT * FROM' . $this->table . 'WHERE ';

        foreach ($params as $key => $value) {
            if(is_string($value)) {
                $comparator = 'LIKE';
            } else {
                $comparator = '=';
            }
            $request .= "$key $comparator :$key AND";
            $params[":$key"] = $value;
            unset($params[$key]);
        }
        $request = rtrim($request, 'AND');

        if($order) {
            $request .= "ORDER BY " . key($order) . " " . $order[$key($order)];
        }
        $results =  $this->sql($request, $params);
        $rows = $results->fetchAll();

        foreach ($rows as $row) {
            $obj = new $this->class();
            array_push($results, $obj->hydrate($row));
        }
        return $results;
    }

    /**
     * @return un tableau d'objet rempli
     */
    public function findAll() {
        $request = 'SELECT * FROM' . $this->table;
        $results = $this->sql($request);
        return $results;
    }

    /**
     * Compte le nombre d'éléments d'une table.
     */
    public function count() {
        $request = 'SELECT COUNT(*) AS myCount FROM' . $this->table;
        $result = $this->sql($request);
        return $result['myCount'];
    }

    public function delete(int $id): bool {
        //
    }


    public function save($objectToSave)
    {
        // Récupération du nom de la table de façon dynamique
        $objectArray = $objectToSave->__toArray();
        $columnsData = array_values($objectArray);
        $columns = array_keys($objectArray);
        // On met 2 points devant chaque clé du tableau
        $params = array_combine(
            array_map(function ($key) {
                return ':' . $key;
            }, array_keys($objectArray)),
            $objectArray
        );

        if (!is_numeric($objectToSave->getId())) {
            // INSERT -> Requête dynamique et préparée
            $request = "INSERT INTO " . $this->table . " (" . implode(",", $columns) . ") VALUES (:" . implode(",:", $columns) . ");";
        } else {
            // UPDATE
            foreach ($columns as $column) {
                $sqlUpdate[] = $column . "=:" . $column;
            }

            $request = "UPDATE " . $this->table . " SET " . implode(",", $sqlUpdate) .  " WHERE id=:id;";
        }

        $this->sql($request, $params);
    }

    // Modifier un user on reset toute les info - eviter
    // setID
    public function populate()
    {
    }
}
