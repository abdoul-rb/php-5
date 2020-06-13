<?php

namespace App\Core\Builder;

use App\Core\Connection\DBInterface;
use App\Core\Connection\PDOConnection;

class QueryBuilder
{
    private $connection;
    private $query;
    private $parameters;
    private $alias;

    public function __construct(DBInterface $connection = null)
    {
        $this->connection = $connection;

        if(null === $connection) {
            $this->connection = new PDOConnection();
        }

        $this->query = '';
        $this->parameters = [];
    }

    public function select(string $value): QueryBuilder {
        $this->addToQuery('SELECT ' . $value);
        return $this;
    }

    public function from(string $table, string $alias): QueryBuilder {
        $this->addToQuery('FROM ' . $table . ' ' . $alias);
        $this->alias = $alias;
        return $this;
    }

    public function where(string $conditions): QueryBuilder {
        $this->addToQuery('WHERE ' . $conditions);
        return $this;
    }

    public function setParameters(string $key, string $value): QueryBuilder {
        $this->parameters[':' . $key] = $value;
        return $this;
    }

    public function join(string $table, string $aliasTarget, string $fieldSource, string $fieldTarget): QueryBuilder {
        $aliasSource = $this->alias;
        $this->addToQuery("JOIN $table $aliasTarget ON $aliasTarget.$fieldTarget = $aliasSource.$fieldSource");
        return $this;
    }
}