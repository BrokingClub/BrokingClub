<?php
/**
 * Project: BrokingClub | RepositoryCache.php
 * Author: Simon - www.triggerdesign.de
 * Date: 08.05.2015
 * Time: 14:30
 */

namespace BrokingClub\Cache;


class RepositoryCache extends ObjectCache{
    protected $class = "EmptyClass";

    public function findById($id, $fail = true){
        $inCache = $this->get($id);

        if($inCache) return $inCache;


        $class = $this->class;
        if(strpos($class, "\\") === false) $class = "\\" . $class;

        if(!$fail){
            $newObject = $class::find($id);
        } else {
            $newObject = $class::findOrFail($id);
        }

        $this->store($id, $newObject);

        return $newObject;

    }

} 