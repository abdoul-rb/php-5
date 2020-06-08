<?php

namespace App\Command;

use App\Models\User;
use App\Core\Command\Receiver;
use App\Core\Command\CommandInterface;
use App\Managers\UserManager;

class UserCreateCommand implements CommandInterface
{
    private $output;
    private $args;

    public function __construct(Receiver $console)
    {
        $this->output = $console;
        $this->output->enableDate();
    }

    public function setArgs(array $args): self
    {
        $this->args = $args;

        return $this;
    }

    public function execute()
    {
        $this->output->write('Create new user...');

        $user = new User();
        $user->setFirstname($this->args[0]);
        $user->setLastname($this->args[1]);
        $user->setPwd($this->args[2]);
        $user->setEmail($this->args[3]);
        $user->setStatus(0);

        $this->output->write('Saving new user...');
        $userManager = new UserManager();
        $userManager->save($user);


        $this->output->write('New user saved');
        $this->output->write($this->args[0]);
        $this->output->write($this->args[1]);
        $this->output->write($this->args[2]);

        $this->output->printOutPut();
    }
}