<?php
/**
 * Project: BrokingClub | CacheManager.php
 * Author: Simon - www.triggerdesign.de
 * Date: 30.04.2015
 * Time: 18:18
 */

namespace BrokingClub\Cache;


class CacheManager {
    /**
     * @var array[ObjectCache]
     */
    public $caches = [];

    public function addCache($id, $class){
        if($this->has($id))
            return $this->get($id);

        $fullClass = "BrokingClub\\Cache\\" + $class;

        $newCache = \App::make($fullClass);

        $this->caches[$id] = $newCache;

        return $newCache;
    }

    public function get($id){
        if($this->has($id))
            return $this->caches[$id];

        return null;
    }

    public function has($id){
        if(isset($this->caches[$id]))
            return true;

        return false;
    }
}