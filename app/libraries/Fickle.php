<?php
/**
 * Project: BrokingClub | Fickle.php
 * Author: Simon - www.triggerdesign.de
 * Date: 17.10.2014
 * Time: 16:56
 */

class Fickle {
    public static function openPanel($title = "Panel title", $cols = 12, $options = array()){
        $class = (isset($options['class']))? $options['class'] : 'fickle-panel';

        $html = '<div class="col-md-'. $cols .'">';
        $html .= '<div class="panel panel-default '. $class .'">';
            $html .= '<div class="panel-heading">';
                $html .= '<h3 class="panel-title">'. $title .'</h3>';
            $html .= '</div>';
            $html .= '<div class="panel-body">';

        return $html;
    }

    public static function closePanel(){
        return "</div></div></div>";
    }
} 