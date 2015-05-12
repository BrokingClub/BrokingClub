<?php

class Player extends BaseModel {
	protected $fillable = ['firstname', 'lastname', 'career_id', 'club_id', 'club_role', 'balance', 'exp'];

    public static $rules = array(
        'firstname' => 'Min:3|Max:80|alpha_spaces',
        'lastname' => 'Min:3|Max:80|alpha_spaces'
    );

    public function user(){
        return $this->belongsTo('User');
    }

    public function career(){
        return $this->belongsTo('Career');
    }

    public function club() {
        return $this->belongsTo('Club');
    }

    public function purchases(){
        return $this->hasMany('Purchase')->orderBy('created_at', 'DESC')->where('mode', '<>', 'sold');
    }

    public function sold(){
        return $this->hasMany('Purchase')->orderBy('created_at', 'DESC')->where('mode', '=', 'sold');
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

    public function editAllowed($userId = 0){
        if($userId == 0) $userId = $this->user->id;

        return User::canEdit($userId);
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

    public function name($hide_username = true) {
        if(!$this->user){
            throw new Exception("Unkown user ". $this->user_id ." for player " . $this->id);
        }

        $name = $this->user->username;
        $fullname = trim(implode(' ', [$this->firstname, $this->lastname]));

        if($fullname != ""){
            if(!$hide_username)
                $name = "[" . $name . "] " . $fullname;
            else
                $name = $fullname;
        }

        return $name;
    }

    public function link($options = []){
        $string = $this->name();

        if(isset($options['showRole']))
            $string .= " [" . $this->role() . ']';

        return "<a href=". URL::route('players.show', $this->id) .">". $string ."</a>";
    }

    public function role(){
        return trans('roles.' . $this->club_role);
    }



    public function ownsClub($club = null){

        $isowner = $this->club_role == "founder";

        if(is_null($club))
            return $isowner;
        else{
            $inclub = $this->club_id == $club->id;
            return $inclub && $isowner;
        }
    }

    public function clubLink($attributes = array()){
        $club_name = "[no club]";
        $htmlAttributes = HTML::attributes($attributes);
        $club_link = URL::route('clubs.index');
        if($this->club_id != 0){
            $club_name = $this->club->name;
            $club_link = URL::route('clubs.show', $this->club_id);
        }

        return "<a ". $htmlAttributes ." href='". $club_link ."'>". $club_name ."</a>";
    }

    public function careerName(){
        $career = $this->career;

        if(!$career) return '---';
        else {
            return $career->name . " - Lvl ". intval($this->level);
        }
    }

    public function canJoin($club_id){
        return $club_id != Player::auth()->club_id;
    }


}