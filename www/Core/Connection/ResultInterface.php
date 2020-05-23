<?php

namespace App\Core\Connection;

interface ResultInterface
{
    public function getArrayResult();
    public function getOneOrNullResult();
    public function getValueResult();
}