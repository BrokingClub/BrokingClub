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

    public function charge($price){
        $balance = $this->balance;

        if($balance < $price)
            return false;

        $this->balance -= $price;

        $this->save();

        return true;
    }

    public static function auth(){
        $theUser = Auth::user();
        if(!$theUser) return null;

        $thePlayer = $theUser->player;

        return $thePlayer;
    }
}