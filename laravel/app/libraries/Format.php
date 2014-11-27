<?php
/**
 * Project: BrokingClub | Fickle.php
 * Author: Simon - www.triggerdesign.de
 * Date: 17.10.2014
 * Time: 16:56
 */

class Format {
    public static function num($number){
        return number_format($number, 2, '.', ',');
    }

    public static function money($number){
        return static::num($number) . "$";
    }

}