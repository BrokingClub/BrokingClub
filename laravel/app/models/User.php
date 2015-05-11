<?php

use Triggerdesign\Hermes\Models\UserTrait as HermesTrait;
use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;

class User extends BaseModel implements ConfideUserInterface
{
    use HermesTrait;
    use ConfideUser;

    protected $fillable = ['email', 'username'];

    public static $rules = array(

    );

    public function player(){
        return $this->hasOne('Player');
    }

    public function delete(){
        $this->player()->delete();

        return parent::delete();
    }

    public function isAdmin(){
        return $this->role === "admin";
    }

    public static function canEdit($user_id){
        $auth_id = Auth::user()->id;

        if($user_id == $auth_id)    return true;
        else                        return false;

    }

    public static function canEditOrFail($user_id){
        $canEdit = static::canEdit($user_id);

        if(!$canEdit){
            App::abort(403, 'Unauthorized action. You cannot edit this user.');
            return false;
        } else {
            return true;
        }
    }

    public function name(){
        return $this->player->name();
    }
}