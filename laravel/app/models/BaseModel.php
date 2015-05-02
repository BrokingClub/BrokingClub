<?php
/**
 * Project: BrokingClub | BaseModel.php
 * Author: Simon - www.triggerdesign.de
 * Date: 23.11.2014
 * Time: 20:31
 */

class BaseModel extends \Eloquent{
    public static $validationMessages = null;

    public function __construct(array $attributes = array())  {
        parent::__construct($attributes); // Eloquent
    }

    public function fill(array $attributes){
        $result = parent::fill($attributes);

        if(method_exists($this, 'filled'))
            $this->filled($attributes);

        return $result;
    }


    public static function validate($input = null, $useRules = "all") {
        if (is_null($input)) {
            $input = Input::all();
        }

        $rules = static::$rules;

        if($useRules != "all"){
            $useRules = explode(',', $useRules);
            $filteredRules = array();
            foreach($useRules as $useRule){
                $filteredRules[$useRule] = $rules[$useRule];
            }

            $rules = $filteredRules;
        }

        $v = Validator::make($input, $rules);

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

    protected function urlId(){
        return $this->id;
    }
} 