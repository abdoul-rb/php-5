<?php
namespace App\Core;

use App\Core\Connection\DBInterface;
use App\Core\Connection\PDOConnection;

class QueryBuilder
{
    private $select;
    private $from;
    private $where = [];
    private $group;
    private $order;
    private $limit;
    private $params;
    private $pdo;


    public function __construct(?PDOConnection $pdo = null)
    {
        $this->pdo = $pdo;
    }

    public function select(string ...$fields): self {
        $this->select = $fields;
        return $this;
    }

    public function from(string $table, ?string $alias = null): self {
        if($alias) {
            $this->from[$alias] = $table;
        } else {
            $this->from[] = $table;
        }

        return $this;
    }

    public function where(string ...$condition): self {
        $this->where = array_merge($this->where, $condition);
        return $this;
    }

    public function setParameter(array $params): self {
        $this->params = $params;
        return $this;
    }

    public function andWhere($where) {}

    public function orWhere($where) {}

    public function groupBy($groupBy) {}

    public function addGroupBy($groupBy) {}

    public function delete($delete = null, $alias = null) {}

    public function update($update = null, $alias = null) {}

    public function set($key, $value) {}

    public function join($join, $alias, $conditionType = null, $condition = null, $indexBy = null) {}

    public function innerJoin($join, $alias, $conditionType = null, $condition = null, $indexBy = null) {}

    public function leftJoin($join, $alias, $conditionType = null, $condition = null, $indexBy = null) {}

    public function having($having) {}

    public function andHaving($having) {}

    public function orHaving($having) {}

    public function orderBy($sort, $order = null) {}

    public function addOrderBy($sort, $order = null) {}

    /**
     * En supposant que la base de données est bien normalisée et que la clé primaire des tables c'est toujours 'id'
     * @return int
     */
    public function count(): int {
        $this->select('COUNT(id)');
        return $this->getQuery()->getValueResult();
    }

    public function getQuery() {
        $query = $this->__toString();
        return $this->pdo->query($query);
    }

    public function __toString()
    {
        $parts = ['SELECT'];

        if($this->select) {
            $parts[] = join(', ', $this->select);
        } else {
            $parts[] = '*';
        }

        $parts[] = 'FROM';
        $parts[] = $this->buildFrom();

        if(!empty($this->where)) {
            $parts[] = 'WHERE';
            $parts[] = '('. join(') AND (', $this->where) . ')' ;
        }

        return join(', ', $parts);
    }

    private function buildFrom(): string {
        $from = [];

        foreach ($this->from as $key => $value) {
            if(is_string($key)) {
                $from[] = "$value as $key";
            } else {
                $from[] = $value;
            }
        }
        return join(', ', $from);
    }
}