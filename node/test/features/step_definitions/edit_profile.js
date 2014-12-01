var no = require('app/no');

module.exports = function(){
    this.World = require('../support/world.js').World;
    
    /* Background */
    this.Given('I am logged in as a test user', function(callback){
        var browser = this.browser;
        
        this.visit('http://broking.club/login', function(err){
            if(no(err)){
                callback.pending();
                browser
                    .fill('email', 'test@broking.club')
                    .fill('password', 'test');
                    /*.pressButton('button', function(err){
                        callback.pending();
                    });*/
            }else{
                callback.fail(err);
            }
        });
    });
    
    this.Given('I am on the profile page', function(callback){
        callback.pending();
    });
    /* Background */
    /* Scenario */
    this.When('I enter the following text in first name: "first_name"', function(firstName, callback){
        callback.pending();
    });
    
    this.When('I enter the following text in last name: "last_name"', function(lastName, callback){
        callback.pending();
    });
    
    this.Then('I should see "Profile has been updated"', function(message, callback){
        callback.pending();
    });
    /* Scenario */
    this.When('I enter the following text in first name: "%/&_not_a_valid_firstname:)"', function(callback){
        callback.pending();
    });
    
    this.When('I enter the following text in last name: "&%not_a_valid_lastname(/"', function(callback){
        callback.pending();
    });
    
    this.Then('I should see "Non valid input!"', function(callback){
        callback.pending();
    });
    /* Scenario */
};