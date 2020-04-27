<?php

namespace App\Core;

class Model {
    public function __toArray(): array {
        $property = get_object_vars($this);
        die($property);
        return $property;
    }

    public function hydrate(array $data)
    {
        $className = get_class($this);
        $obj = new $className();

        foreach ($data as $attributName => $attributValue) {
            $settername = 'set'. ucfirst($attributName);

            if(method_exists($settername)) {
                $obj->$settername($attributValue);
            }
        }
        return $obj;
    }

}