<?php
namespace App\Core;

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

            return $queryPrepared;
        }
    }

    /**
     * Récupère un élément de l'objet courant en base de données.
     * @param int $id
     * @return l'objet courant avec les données remplies
     */
    public function find(int $id) {
        $request = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';

        $result = $this->sql($request, [':id' => $id]);
        $row = $result->fetch();

        if ($row) {
            $object = new $this->class();
            return $object->hydrate($row);
        } else {
            return null;
        }
    }

    /**
     * @return un tableau d'objet rempli
     */
    public function findAll() {
        $request = 'SELECT * FROM' . $this->table;

        $result = $this->sql($request);

        return $result;
    }

    /**
     * Compte le nombre d'éléments d'une table.
     */
    public function count() {
        $request = 'SELECT COUNT(*) FROM' . $this->table;

        $result = $this->sql($request);

        return $result;
    }


    public function save()
    {
        // Récupération du nom de la table de façon dynamique
        $objectVars = get_object_vars($this);
        $classVars = get_class_vars(get_class());
        $columnsData = array_diff_key($objectVars, $classVars);
        $columns = array_keys($columnsData);

        if (!is_numeric($this->id)) {
            // INSERT -> Requête dynamique et préparée
            $sql = "INSERT INTO " . $this->table . " (" . implode(",", $columns) . ") VALUES (:" . implode(",:", $columns) . ");";
        } else {
            // UPDATE
            foreach ($columns as $column) {
                $sqlUpdate[] = $column . "=:" . $column;
            }

            $sql = "UPDATE " . $this->table . " SET " . implode(",", $sqlUpdate) .  " WHERE id=:id;";
        }

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($columnsData);
    }

    // Modifier un user on reset toute les info - eviter
    // setID
    public function populate()
    {
    }
}
