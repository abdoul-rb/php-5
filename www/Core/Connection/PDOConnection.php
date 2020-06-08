<?php

namespace App\Core\Connection;

class PDOConnection implements DBInterface
{
    protected $pdo;

    public function __construct()
    {
        $this->connect();
    }

    public function connect(){
        try {
            $this->pdo = new PDO(DRIVER_DB.":host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PWD_DB);
        } catch (\Trowable $t) {
            die('Erreur SQL' . $t->getMessage());
        }
    }

    /**
     * Permet d'effectuer une requête PDO vers la base de données.
     * @param string $request la requête à effectuer.
     * @param array $parameters les paramètres de la requête.
     * @return mixed
     */
    public function query(string $request, array $parameters = null)
    {
        if ($parameters) {
            $queryPrepared = $this->pdo->prepare($request);
            $queryPrepared->execute($parameters);

            return new PDOResult($queryPrepared);
        } else {
            $queryPrepared = $this->pdo->prepare($request);
            $queryPrepared->execute();

            return new PDOResult($queryPrepared);
        }
    }
}