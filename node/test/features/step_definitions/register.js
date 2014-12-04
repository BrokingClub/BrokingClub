var no = require('app/no');

module.exports = function(){
    this.World = require('../support/world.js').World;
    
    /* Background */
    this.Given('I am on the BrokingClub register page', function(callback){
        this.browser.visit('http://broking.club/register', callback);
    });
    /* Background */
    /* Scenario */
    this.When('I enter the following text in username: "$username"', function(username, callback){
        this.browser.fill('username', username);
        callback(); 
    });
    
    this.When('I enter the following text in email: "$email"', function(email, callback){
        this.browser.fill('email', email);
        callback(); 
    });
    
    this.When('I enter the following text in password: "$password"', function(password, callback){
        this.browser.fill('password', password);
        callback(); 
    });
    
    this.When('I enter the following text in repeat_password: "$password"', function(password, callback){
        this.browser.fill('repeat_password', password);
        callback(); 
    });
    
    this.When('I click on register', function(callback){
        this.browser.pressButton('button', callback); 
    });
    
    this.Then('I should be redirected to the login page', function(callback){
        if(this.browser.location.pathname === '/login'){
            callback();
        }else{
            callback.fail('Not on the login page');   
        }
    });
    /* Scenario */
    this.When('I enter the following text in username: "$username"', function(username, callback){
        this.browser.fill('username', username);
        callback(); 
    });
    
    this.When('I enter the following text in email: "$email"', function(email, callback){
        this.browser.fill('email', email);
        callback(); 
    });
    
    this.When('I enter the following text in password: "$password"', function(password, callback){
        this.browser.fill('password', password);
        callback(); 
    });
    
    this.When('I enter the following text in repeat_password: "$password"', function(password, callback){
        this.browser.fill('repeat_password', password);
        callback(); 
    });
    
    this.whenen('I click on register', function(callback){
        this.browser.pressButton('button', callback);  
    });
    
    this.Then('I should see an error message', function(callback){
        if(this.browser.query('div.alert-error')){
            callback();
        }else{
            callback.fail('No error alert found');   
        }
    });
    /* Scenario */
};