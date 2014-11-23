<?php
/**
 * Project: BrokingClub | BaseModel.php
 * Author: Simon - www.triggerdesign.de
 * Date: 23.11.2014
 * Time: 20:31
 */

class BaseModel extends \Eloquent{
    public static $validationMessages = null;

    public static function validate($input = null) {
        if (is_null($input)) {
            $input = Input::all();
        }

        $v = Validator::make($input, static::$rules);

        if ($v->passes()) {
            return true;
        } else {
            // save the input to the current session
            Input::flash();

            self::$validationMessages = $v->messages();
            Session::flash('validationErrors',  self::$validationMessages);
            return false;
        }
    }

    public function validateAndSave($input = null){
        if (is_null($input)) {
            $input = Input::all();
        }

        $validate = static::validate($input);

        if($validate){
            $this->fill($input);
            $this->save();
            return true;
        } else {

            return false;
        }

    }
} 