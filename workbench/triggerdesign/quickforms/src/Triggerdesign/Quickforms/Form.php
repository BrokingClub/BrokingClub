<?php

namespace Triggerdesign\Quickforms;

/**
 * Project: Brainlovers | QForm.php
 * Author: Simon - www.triggerdesign.de
 * Date: 30.09.14
 * Time: 12:59
 */



class Form extends \Bootstrapper\Form{

    private $autoTranslate;

    private $errorSessionKey;
    private $labelTranslationBase;

    /**
     * Create a new form builder instance.
     *
     * @param  \Illuminate\Routing\UrlGenerator  $url
     * @param  \Illuminate\Html\HtmlBuilder  $html
     * @param  string  $csrfToken
     * @return void
     */
    public function __construct(\Illuminate\Html\HtmlBuilder $html, \Illuminate\Routing\UrlGenerator $url, $csrfToken)
    {
        parent::__construct($html, $url, $csrfToken);

        $this->autoTranslate =  $this->getConfig("autoTranslate");
        $this->errorSessionKey = $this->getConfig("errorSessionKey");
        $this->labelTranslationBase = $this->getConfig("labelTranslationBase");

    }

    private function getConfig($key, $default = false){
        return \Config::get('quickforms::'. $key, $default);
    }

    public function text($name, $value = null, $options = array()){
        $inputHtml = parent::text($name, $this->getValue($name, $value, $options), $this->argsOf($name, $options));
        $labelHtml = $this->getLabelHtml($name, $options);

        return $this->element('text', $name, $inputHtml, $labelHtml, $options);
    }

    public function url($name, $value = null, $options = array()){
        $inputHtml = parent::url($name, $this->getValue($name, $value, $options), $this->argsOf($name, $options));
        $labelHtml = $this->getLabelHtml($name, $options);

        return $this->element('text', $name, $inputHtml, $labelHtml, $options);
    }

    public function password($name, $options = array()){
        $inputHtml = parent::password($name, $this->argsOf($name, $options));
        $labelHtml = $this->getLabelHtml($name, $options);

        return $this->element('password', $name, $inputHtml, $labelHtml, $options);
    }

    public function textarea($name, $value = null, $options = array()){
        $inputHtml = parent::textarea($name, $this->getValue($name, $value, $options), $this->argsOf($name, $options));
        $labelHtml = $this->getLabelHtml($name, $options);

        return $this->element('textarea', $name, $inputHtml, $labelHtml, $options);
    }

    public function select($name, $list = array(), $selected = null, $options = array()){
        $inputHtml = parent::select($name, $this->getValue($name, $selected, $options), $this->argsOf($name, $options));
        $labelHtml = $this->getLabelHtml($name, $options);

        return $this->element('select', $name, $inputHtml, $labelHtml, $options);
    }

    public function submit($value = false, $options = array()){
        return parent::submit($this->getAutoTranslation('submit'), $options);
    }

    private function element($type, $name, $inputHtml, $labelHtml = null, $options = array()){
        $errors = $this->getErrors($name);

        $containerCss = "form-group qform-element ";

        if($errors){
            $containerCss .= "has-error has-feedback ";
        } else {
            $containerCss .= "has-no-error has-no-feedback ";
        }

        $output = '<div class="'. $containerCss .'">';

        $output .= $labelHtml;
        $output .= $inputHtml;

        if($errors){
            $error = (is_array($errors))? reset($errors) : $errors;
            $output .= "<b class='text-danger'>". ucfirst($error). "</b>";
        }

        $output .= '</div>';

        return $output;
    }

    private function getLabelHtml($name, $options){
        $labelText = (isset($options['label'])) ? $options['label'] : null;

        if(!$labelText && isset($options['translation'])){
            $labelText = \Lang::get($options['translation']);
        }

        if(!$labelText){
            $labelText = $this->getAutoTranslation($name);
        }

        if(!$labelText) return null;

        return parent::label($name, $labelText, array());
    }

    private function getAutoTranslation($name){
        if(!$this->autoTranslate)   return false;

        $translationKey = $this->getLabelTranslationKey($name);
        if($translationKey)
            return \Lang::get($translationKey);
        else
            return false;
    }

    private function getValue($name, $value, $options){
        $realValue = $this->getValueAttribute($name, $value);

        if(isset($options['overrideValue']))
            $realValue = $options['overrideValue'];

        if(empty($realValue) && isset($options['hardPlaceholder']))
            $realValue = $options['hardPlaceholder'];

        return $realValue;
    }

    private function getErrors($name){
        $errors = \Session::get($this->errorSessionKey);

        if(is_array($errors))
            return $this->getErrorsArray($name, $errors);

        if(!$errors || !$errors->has($name) )   return false;
        else                                    return $errors->get($name);

    }

    private function getErrorsArray($name, $array){
        if(isset($array[$name])) {
            return $array[$name];
        }
        else
            return null;
    }


    private function getLabelTranslationKey($name){
        $translationKey = $this->labelTranslationBase . $name;

        if(\Lang::has($translationKey))
            return $translationKey;
        else
            return false;
    }

    private function argsOf($name, $options){
        $arguments = (isset($options['arguments']))? $options['arguments'] : array();

        $argumentKeys = array('class', 'id', 'placeholder');
        foreach($argumentKeys as $argumentKey){
            if(!isset($options[$argumentKey])) continue;

            $arguments[$argumentKey] = $options[$argumentKey];
        }

        if(!isset($arguments['class']))
            $arguments['class'] = '';

        $modelClass = false;
        if(isset($options['model'])){
            $modelClass = $options['model'];
        }
        else if(!isset($this->model)){
            $modelClass = get_class($this->model);
        }

        if($modelClass && property_exists($modelClass, 'rules')){
            $rules = $modelClass::$rules;
            if(isset($rules[$name]) && !isset($arguments['data-validation'])){
                $rule = $rules[$name];
                $arguments['data-validation'] = $rule;
                $arguments['class'] .= " validation-input";

                if(in_array("required", explode('|', $rule))){
                    $arguments['class'] .= " required-input";
                }
            }

        }




        return $arguments;
    }





}