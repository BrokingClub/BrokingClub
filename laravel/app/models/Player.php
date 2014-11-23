<?php

class Player extends BaseModel {
	protected $fillable = ['firstname', 'lastname'];

    public static $rules = array(
        'firstname' => 'Min:3|Max:80|Alpha',
        'lastname' => 'Min:3|Max:80|Alpha'
    );

    public function user(){
        return $this->hasOne('User');
    }
}