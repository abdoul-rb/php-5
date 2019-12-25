<?php

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
