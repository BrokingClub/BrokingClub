<?php
/**
 * Project: BrokingClub | FontAwesome.php
 * Author: Simon - www.triggerdesign.de
 * Date: 30.04.2015
 * Time: 22:42
 */

namespace BrokingClub\View;


class FontAwesome {

    public static function changeRateIcon($mode){
        switch ($mode) {
            case "rising":
                return "<i class='fa fa-caret-up'></i>";
            case "falling":
                return "<i class='fa fa-caret-down'></i>";
            default:
                return "<i class='fa fa-sort'></i>";
        }
    }
} 