<?php
/**
 * Project: BrokingClub | Fickle.php
 * Author: Simon - www.triggerdesign.de
 * Date: 17.10.2014
 * Time: 16:56
 */

class Fickle {

    private static $closeDivComment = true;
    private static $lastActivetab;
    private static $lastWidgetType;

    public static function openPanel($title = "Panel title", $cols = 12, $options = array()){
        $class = (isset($options['class']))? $options['class'] : 'fickle-panel';

        $panelBodyClass = 'panel-body';
        if(isset($options['padding']) && $options['padding'] === false)
            $panelBodyClass .= ' no-padding';


        $html = '<div class="'. static::colsCssClass($cols)  .'">';
        $html .= '<div class="panel panel-default '. $class .'">';
            $html .= '<div class="panel-heading">';
                $html .= '<h3 class="panel-title">'. $title .'</h3>';
            $html .= '</div>';
            $html .= '<div class="'. $panelBodyClass .'">';

        return $html;
    }

    public static function closePanel(){
        return "</div></div></div>";
    }

    public static function openWidget($cols = 12, $type = "setting", $title = "", $icon = null){
        $html = '<div class="widget-container col-md-4 col-sm-6">';
        $html .=  '<div class="'. $type .'-widget">';
            $html .=  '<div class="'. $type .'-widget-header">';
            $html .=  '<h5 class="ls-header">'. $title .' <i class="fa fa-'. $icon .'"></i></h5>';
        $html .=  '</div>';
        $html .=  '<div class="setting-widget-box">';

        static::$lastWidgetType = $type;

        return $html;
    }

    public static function closeWidget(){
        $html = static::closeDiv(static::$lastWidgetType . '-widget-box');
        $html .= static::closeDiv(static::$lastWidgetType . '-widget');
        $html .= static::closeDiv('widget-container');

        return $html;
    }

    private static function closeDiv($for = ""){
        $html = "</div>";
        if(!empty($for) && static::$closeDivComment)
            $html .= '<!-- '. $for .' -->';

        return $html;
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

    public static function openTable(){
        $html = '<div class="table-responsive ls-table">';
        $html .= '<table class="table table-striped table-responsive">';

        return $html;
    }

    public static function closeTable(){
        $html = '</table>';
        $html .= static::closeDiv('table-responsive');
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

    public static function earnings($purchase) {
        $earned = $purchase->earned();
        $earnedFormatted = Format::money($earned);



        return $earnedFormatted;
    }

    public static function stockValue($stock, $options = array('big' => true)){
        $labelSizeClass = ($options['big']) ? 'bigger-label' : 'normal-label';
        $stockValue = $stock->newestValue();
        $changeRatePercent = $stock->changeRatePercent();

        $mode = "neutral";
        if($changeRatePercent > 0) $mode = "positive";
        else if($changeRatePercent < 0) $mode = "negative";

        $cssClasses = [
            'change-rate' => [
                'neutral' => 'label label-as-badge '. $labelSizeClass . ' label-neutral',
                'positive' => 'label label-as-badge '. $labelSizeClass . ' label-success',
                'negative' => 'label label-as-badge '. $labelSizeClass . ' label-danger'
            ]
        ];

        $rateCss = $cssClasses['change-rate'][$mode];

        $html = "<div class='stock-value stock-value-". $mode ."'>";
        $html .= "<span class='value'>". Format::value($stockValue) ."</span> ";
        $html .= "<span class='change-rate ". $rateCss ."'>". $changeRatePercent ."%</span>";
        $html .= "</div>";

        return $html;
    }

    public static function iconBtn($icon, $mode) {
        return '<button class="btn btn-'.$mode.'"><i class="fa fa-'.$icon.'"></i></button>';
    }

    public static function purchaseMode($mode){
        $icon = ($mode == "rising")? 'sort-amount-asc' : 'sort-amount-desc';
        return '<i class="fa fa-'. $icon .' fa-rotate-270"></i>';


    }
}

