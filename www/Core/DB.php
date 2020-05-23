<?php
namespace App\Core;

use App\Core\Connection\DBInterface;
use App\Core\Connection\PDOConnection;

class DB
{
    private $table;
    private $connection;
    protected $class;
    private static $_instance;

    // SINGLETON
    public function __construct(string $class, string $table, DBInterface $connection = null)
    {
        $this->class = $class;
        $this->table = PREFIXE_DB . $table;
        $this->connection = $connection;

        if(NULL === $connection) {
            $this->connection = new PDOConnection();
        }

        $this->table = PREFIXE_DB . get_called_class();
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance)){

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
        $row = $result->getOneOrNullResult();

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
        $rows = $results->getArrayResult();

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
    public function count(array $params): int {
        $request = 'SELECT COUNT(*) AS myCount FROM' . $this->table . "WHERE ";

        foreach ($params as $key => $value) {
            if(is_string($value)) {
                $comparator = 'LIKE';
            } else {
                $comparator = '=';
            }
            $request .= " $key $comparator :$key AND";
            unset($params[$key]);
        }
        $request = rtrim($request, 'AND');
        $result = $this->sql($request, $params);
        return $result->getValueResult();
    }

    public function delete(int $id): bool {
        $request = "DELETE FROM $this->table WHERE id = :id";
        $result = $this->sql($request, [':id' => $id]);

        return true;
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
