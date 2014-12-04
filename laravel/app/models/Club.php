<?php

class Club extends \BaseModel {

    public static $rules = array(
        'name'          => 'required|unique:clubs|between:1,100',
        'slug'          => 'required|unique:clubs|between:3,10|alpha_dash',
        'teaser'        => 'required|between:5,150',
        'description'   => 'between:1,999',
    );


    protected $fillable = ['name', 'slug', 'teaser', 'description'];

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