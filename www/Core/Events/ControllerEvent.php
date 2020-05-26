<?php

namespace App\Core\Events;

use SplObserver;
use SplSubject;

class ControllerEvent implements SplObserver
{

    public function __construct()
    {
        //$this->logger = new Logger()
    }
    /**
     * @var SplSubject[]
     */
    private $controllers = [];

    /**
     * It is called by the Subject, usually by SplSubject::notify()
     */
    public function update(SplSubject $subject)
    {
        $this->controllers[] = clone $subject;
        // Passer la fonction logged ici $this->logged()
    }

    /**
     * @return SplSubject[]
     */
    public function getChangedController(): array
    {
        return $this->controllers;
    }

    public function logged(string $uri): void
    {
        echo "Url appelé ( $uri ) le ". date('Y-m-d H:i');
        // $this->logger->info("Url appelé ( $uri ) le ". date('Y-m-d H:i'))
    }
}