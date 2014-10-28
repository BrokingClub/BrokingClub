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
    private static $shortCodePattern = '\[\[([a-z0-9]{2,15}) ([\sa-zA-Z="0-9.:\/_\-]*)\]\]';
    private static $varOutputPattern = '\[\[\$([a-zA-Z0-9]*)\]\]';
    private $navigation = array();
    private $loaded = false;
    public $defaultDirectory = '';

    public function __construct(){

    }

    public function loadFile(){
        if($this->loaded) return false;

        $this->activeFile = $this->getActiveFile();
        $this->markdownPath = $this->activeFile['path'];

        if(!file_exists($this->markdownPath)){
            throw new \Exception($this->markdownPath . " not found");
            return false;
        }

        $this->markdownOri = file_get_contents($this->markdownPath);

        $this->loaded = true;


    }

    public function setVariables($variables){
        $this->variables = $variables;
    }

    public function parseMarkdown(){
        $this->loadFile();

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
            case "include":
                if(!isset($options["url"]))
                    return "_NO_URL_SET";
                $fileContent = utf8_decode(file_get_contents($options['url']));

                if(!$fileContent)
                    return "_FILE_CONTENTS_NOT_FOUND_";
                else {
                    $html = "```" . $this->getFileLanguage($options['url']) . "\r\n";
                    $html .= trim($fileContent);
                    $html .= "\r\n```";

                    return $html;
                }
            case "printvar":
                if(isset($this->variables[$options['key']]))
                    return $this->variables[$options['key']];
                else
                    return "_VAR NOT FOUND_";

        }
    }

    private function getFileLanguage($path){
        if($this->endsWith($path, '.feature')) return "gherkin ";
        if($this->endsWith($path, '.blade.php')) return "html";
        if($this->endsWith($path, '.php')) return "php";
        if($this->endsWith($path, '.js')) return "javascript";
        if($this->endsWith($path, '.html')) return "html";

        return "";
    }

    function endsWith($haystack, $needle)
    {
        return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
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



    public function addFile($title, $path, $shortname, $navigation = false){
        $fileArray = array('title' => $title, 'path' => $this->defaultDirectory . $path, 'shortname' => $shortname, 'navigation' => $navigation);


        $this->navigation[] = $fileArray;
    }

    public function addNavigationFile($title, $path, $shortname){
        return $this->addFile($title, $path, $shortname, true);
    }

    public function getActiveFile(){
        $f = (isset($_GET['f'])) ? $_GET['f'] : null;

        $defaultShortName = strtolower($this->navigation[0]['shortname']);

        $activeShortName = null;

        if((isset($_GET['f'])))
            $activeShortName = strtolower($_GET['f']);
        else
            $activeShortName = $defaultShortName;

        $activeFile = null;
        foreach($this->navigation as $fileArray){
            $shortName = strtolower($fileArray['shortname']);

            if($shortName == $activeShortName) $activeFile = $fileArray;
        }

        return $activeFile;

    }

    public function buildNavigationList(){
        $html = '<ul class="documo-navigation">';

        foreach($this->navigation as $fileArray){
            if(!$fileArray['navigation']) continue;

            $title = $fileArray['title'];
            $link = '?f=' . strtolower($fileArray['shortname']);

            $html .= '<li><a title='. $title. ' href="'. $link .'">' . $title  . '</a></li>';
        }

        $html .= '</ul>';

        return $html;
    }

} 