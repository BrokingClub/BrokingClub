<?php

class Club extends \BaseModel {
	protected $fillable = [];

    public function owner() {
        return $this->belongsTo('Player');
    }

    public function members() {
        return $this->hasMany('Player');
    }

    public function countMembers() {
        return $this->members->count();
    }

    public function worth() {
        $worth = 0;

        foreach($this->members as $member) {
            $worth = $worth + $member->totalWorth();
        }

        return $worth;
    }

    public function avgWorth() {
        return $this->worth()/$this->countMembers();
    }

}