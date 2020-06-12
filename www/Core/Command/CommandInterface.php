<?php

namespace App\Core\Command;

interface CommandInterface
{
    public function execute();

    public function setArgs(array $args);
}
