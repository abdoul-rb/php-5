# Project PHP MVC From Scrath [For School]

Il s s'agit d'un projet d'école consistant à développer un **CMS** façon From Scratch dont les fonctionnalités sont propres à un domaine choisi, ici la création de **blog**.

Ce mini framework comprendra :
* Un système de routing natif
* Un framework CSS dont vous trouverez le dépôt [ici](https://)
* Un ORM pour la manipulation de la base de données
* Un moteur de template

En plus de cela, il y'a certaines choses à faire tel que : 
1. Le maquettage sur [Figma](https://www.figma.com/file/MxVaSpJLmtZTrp491bfKQe/cms-project?node-id=0%3A1)
2. La mise en place d'un Style Guide

```php
public function find(int $id)
{
$sql = "SELECT * FROM $this->table where id = :id";

$result = $this->sql($sql, [':id' => $id]);

$row = $result->fetch();

if ($row) {

$object = new $this->class();
return $object->hydrate($row);
} else {
return null;
}

}
```