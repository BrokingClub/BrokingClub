<?php
namespace BrokingClub\Cache;
/**
 * Project: BrokingClub | ObjectCache.php
 * Author: Simon - www.triggerdesign.de
 * Date: 30.04.2015
 * Time: 18:08
 */

abstract class ObjectCache {


    protected $values = [];

    public function store($id, $value){
        $this->values[$id] = $value;
    }

    public function get($id){
        if(!$this->has($id)) return null;

        return $this->values[$id];
    }

    public function has($id){
        if(!isset($this->values[$id])){
            return false;
        }

        return true;
    }


} 