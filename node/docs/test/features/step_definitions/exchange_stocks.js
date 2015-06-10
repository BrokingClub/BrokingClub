var no = require('no.js');

module.exports = function(){
    this.World = require('../support/world.js').World;
    
    /* Background */
    this.Given('I am on the change system dashboard', function(callback){
        this.browser.visit('http://broking.club/register', callback);
    });
    
    this.Given('I click on the "$share" shares', function(share, callback){
        this.browser.clickLink(share, callback);
    });
    /* Background */
    /* Scenario */
    this.When('I enter $amount as the amount to buy', function(amount, callback){
        this.browser.fill('amount', amount);
        callback();
    });
    
    this.When('I click on buy shares', function(callback){
        this.browser.pressButton('button', callback); 
    });
    
    this.Then('I should see a success message', function(callback){
        if(this.browser.query('div.alert-success')){
            callback();
        }else{
            callback.fail('No success message');   
        }
    });
    /* Scenario */
    this.When('I enter $amount as the amount to buy', function(amount, callback){
        this.browser.fill('amount', amount);
        callback();
    });
    
    this.When('I click on buy shares', function(callback){
        this.browser.pressButton('button', callback); 
    });
    
    this.Then('I should see an error message', function(callback){
        if(this.browser.query('div.alert-error')){
            callback();
        }else{
            callback.fail('No error message');   
        }
    });
    /* Scenario */
    this.When('I enter $amount as the amount to buy', function(amount, callback){
        this.browser.fill('amount', amount);
        callback();
    });
    
    this.When('I click on buy shares', function(callback){
        this.browser.pressButton('button', callback); 
    });
    
    this.Then('I should see an error message', function(callback){
        if(this.browser.query('div.alert-error')){
            callback();
        }else{
            callback.fail('No error message');   
        }
    });
    /* Scenario */
};