<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;

class User extends BaseModel implements ConfideUserInterface
{
    use ConfideUser;

    public function player(){
        return $this->belongsTo('Player');
    }
}