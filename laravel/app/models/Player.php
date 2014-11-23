<?php

class Player extends BaseModel {
	protected $fillable = ['firstname', 'lastname'];

    public static $rules = array(
        'firstname' => 'Min:3|Max:80|alpha_spaces',
        'lastname' => 'Min:3|Max:80|alpha_spaces'
    );

    public function user(){
        return $this->belongsTo('User');
    }
}