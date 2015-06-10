'use strict';

module.exports = /*@ngInject*/ function($route){
    return function(){
        var name = '';

        if($route.current){
            name = $route.current.name;
        }

        return name;
    } ;
};