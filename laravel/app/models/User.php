<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;

class User extends Stock implements ConfideUserInterface
{
    use ConfideUser;
}