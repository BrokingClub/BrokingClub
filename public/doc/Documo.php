<?php
/**
 * Project: xampp | Documo.php
 * Author: Simon - www.triggerdesign.de
 * Date: 11.10.2014
 * Time: 18:09
 */

namespace Triggerdesign;


class Documo {

    private $markdownPath;
    private $markdownOri;
    private $markdown;
    private $variables = array();
    //private static $shortCodePattern = '\[([a-z]{2,15})\s([a-zA-Z="0-9]*)\]';
    private static $shortCodePattern = '\[\[([a-z0-9]{2,15}) ([\sa-zA-Z="0-9.]*)\]\]';
    private static $varOutputPattern = '\[\[\$([a-zA-Z0-9]*)\]\]';

    public function __construct($markdownPath){
        $this->markdownPath = $markdownPath;

        if(!file_exists($markdownPath)){
            throw new \Exception($markdownPath . " not found");
            return false;
        }

        $this->markdownOri = file_get_contents($markdownPath);
    }

    public function setVariables($variables){
        $this->variables = $variables;
    }

    public function parseMarkdown(){
        $markdownOri = $this->markdownOri;
        $shortCodePattern = '|' . static::$shortCodePattern . '|';
        $varOutputPattern = '|' . static::$varOutputPattern . '|';



        $markdown = preg_replace_callback($shortCodePattern, function($found){
            return $this->replaceShortCode($found[1], $found[2]);
        }, $markdownOri);

        $markdown = preg_replace_callback($varOutputPattern, function($found){

            return $this->replaceShortCode('printvar', "key=\"" . $found[1] . "\"");
            return $this->replaceShortCode('printvar', "key=\"" . $found[1] . "\"");
        }, $markdown);

        $this->markdown = $markdown;

        return $markdown;


    }


    private function replaceShortCode($type, $optionsString){
        $options =  $this->readOptions($optionsString);

        switch($type){
            case "setvar":
                $this->variables[$options["key"]] = $options["value"];
                return "";
            case "printvar":
                if(isset($this->variables[$options['key']]))
                    return $this->variables[$options['key']];
                else
                    return "_VAR NOT FOUND_";

        }
    }

    private function readOptions($optionsString){
        $options = array();
        $parts = explode("\" ", $optionsString);


        foreach($parts as $part){
            $vars = explode("=\"", $part);

            $optionKey = $vars[0];
            $optionVal = $vars[1];
            $options[$optionKey] = str_replace('"', '', $optionVal);
        }

        return $options;

    }

    public function printMarkdown(){
        echo $this->markdown;
    }

} 