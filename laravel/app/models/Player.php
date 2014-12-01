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

    public function club() {
        return $this->belongsTo('Club');
    }

    public function purchases(){
        return $this->hasMany('Purchase')->orderBy('created_at', 'DESC')->where('mode', '<>', 'sold');
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

    public function totalWorth(){
        return $this->purchasesWorth() + $this->balance;
    }

    public function purchasesWorth(){
        $worth = 0;
        foreach($this->purchases as $purchase){
            $worth += $purchase->sellOffer();
        }

        return $worth;

    }

    public function editAllowed(){
        return User::canEdit($this->user->id);
    }

    public function editAllowedOrFail(){
        $canEdit = $this->editAllowed();

        if(!$canEdit){
            App::abort(403, 'Unauthorized action. You cannot edit this player.');
            return false;
        } else {
            return true;
        }
    }

    public function name() {
        return implode(' ', [$this->firstname, $this->lastname]);
    }
}