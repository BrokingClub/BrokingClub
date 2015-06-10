'use strict';

var app = module.exports = angular.module('Broking Club', ['ngRoute']);

app.config(require('./config'));
require('./services')(app);
require('./controllers')(app);

app.run(function($rootScope, routeName){
    $rootScope.currentPage = routeName;
});