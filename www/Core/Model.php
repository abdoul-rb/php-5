<?php

namespace App\Core;

use JsonSerializable;

class Model implements JsonSerializable 
{
    public function __toArray(): array {
        $property = get_object_vars($this);
        return $property;
    }

    public function hydrate(array $data)
    {
        $className = get_class($this);
        $obj = new $className();

        foreach ($data as $key => $value) {
            $settername = 'set'. ucfirst($key);

            if(method_exists($obj, $settername)) {
                $obj->$settername($value);
            }
        }
        return $obj;
    }

    public function jsonSerialize() {
        return $this->__toArray();
    }

}