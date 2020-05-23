<?php

namespace App\Core\Connection;

interface DBInterface
{
    public function connect();

    public function query(string $query, array $parameters = null);
}