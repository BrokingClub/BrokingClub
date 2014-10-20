<?php
/**
 * Project: BrokingClub | Fickle.php
 * Author: Simon - www.triggerdesign.de
 * Date: 17.10.2014
 * Time: 16:56
 */

class Fickle {

    private static $lastActivetab;

    public static function openPanel($title = "Panel title", $cols = 12, $options = array()){
        $class = (isset($options['class']))? $options['class'] : 'fickle-panel';

        $html = '<div class="'. static::colsCssClass($cols)  .'">';
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

    public static function openTabbedPanel($cols = 12, $tabs = array(), $active = null){
        $html = '<div class="'. static::colsCssClass($cols)  .'">';

        $html .= '<ul class="nav nav-tabs icon-tab icon-tab-home nav-justified">';



        $activeTab = null;
        if(!$active) {
            $tabKeys = array_keys($tabs);
            $activeTab = $tabKeys[0];
        }
        elseif(isset($tabs[$active])) $activeTab = $active;

        static::$lastActivetab = strtolower($activeTab);

        foreach($tabs as $tabKey => $tabName){
            $activeClass = "";

            $iconClass = 'fa fa-home';
            switch($tabKey){
                case 'profile': $iconClass = 'fa fa-user'; break;
                case 'club': $iconClass = 'fa fa-users'; break;
                case 'password': $iconClass = 'fa fa-key'; break;
                case 'delete': $iconClass = 'fa fa-trash'; break;
            }

            if($activeTab && $tabKey == $activeTab)
                $activeClass = "active";
            $html .= '<li class="'. $activeClass .'"> ';
                $html .= '<a href="#'. $tabKey .'" data-toggle="tab"><i class="'. $iconClass .'"></i> <span>'. $tabName .'</span></a>';
            $html .= '</li>';
        }

        $html .= '</ul>';

        $html .= '<div class="tab-content">';

        return $html;
    }

    public static function closeTabbedPanel(){
        $html = "</div></div>";
        return $html;
    }

    public static function openTabContent($tabKey){
        $tabContentClass = "tab-pane fade";
        if(strtolower($tabKey) == static::$lastActivetab){
            $tabContentClass .= ' in active';
        }

        $html = '<div class="'. $tabContentClass .'" id="'. $tabKey .'">';
        return $html;
    }

    public static function closeTabContent(){
        $html = '</div>';
        return $html;
    }

    public static function colsCssClass($cols = 12){
        return "col-md-" . $cols;
    }
} 