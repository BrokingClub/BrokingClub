<?php

class Career extends \BaseModel {
	protected $fillable = [];

    public function players(){
        return $this->hasMany('Player');
    }
}