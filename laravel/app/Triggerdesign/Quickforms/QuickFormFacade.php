<?php
namespace Triggerdesign\Quickforms;


use Illuminate\Support\Facades\Facade;

class QuickformFacade extends Facade{

    protected static function getFacadeAccessor() { return 'quickforms::form'; }
}