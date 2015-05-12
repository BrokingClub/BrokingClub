<?php
/**
 * Project: BrokingClub | BaseModel.php
 * Author: Simon - www.triggerdesign.de
 * Date: 23.11.2014
 * Time: 20:31
 */

class BaseModel extends Eloquent
{
    public static $validationMessages = null;

    private $objectValidation;

    public function __construct(array $attributes = array())  {
        parent::__construct($attributes); // Eloquent
    }

    public function fill(array $attributes){
        $result = parent::fill($attributes);

        $this->callFilled($attributes);

        return $result;
    }

    public function setRawAttributes(array $attributes, $sync = false){
        $result = parent::setRawAttributes($attributes, $sync);

        $this->callFilled($attributes);

        return $result;
    }

    private function callFilled($attributes){
        if(!method_exists($this, 'filled')) return false;

        if(empty($attributes)) return false;

        $this->filled($attributes);
    }


    /**
     * @param null $input
     * @param string $useRules
     * @param bool $flash
     * @return bool
     */
    public static function validate($input = null, $useRules = "all", $flash = true) {
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

            self::$validationMessages = $v->messages();

            if($flash) {
                Input::flash();
                Session::flash('validationErrors', self::$validationMessages);
            }

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

    public function validateAttributes(){
        $passed =  $this->validate($this->attributes, 'all', false);

        $this->objectValidation = static::$validationMessages;

        return $passed;
    }

    /**
     * @return Illuminate\Support\MessageBag | null
     */
    public function getValidationMessages(){
        return $this->objectValidation;
    }

    protected function urlId(){
        return $this->id;
    }
} 