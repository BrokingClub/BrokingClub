var no = require('app/no');

module.exports = function(){
    this.World = require('../support/world.js').World;
    
    /* Background */
    this.Given('I am logged in as a test user', function(callback){
        var browser = this.browser;
        
        this.visit('http://broking.club/login', function(err){
            if(no(err)){
                browser
                    .fill('email', 'test@broking.club')
                    .fill('password', 'test')
                    .pressButton('button', callback);
            }else{
                callback.fail(err);
            }
        });
    });
    
    this.Given('I am on the profile page', function(callback){
        this.browser.clickLink('a[href$="profile"]', callback);
    });
    /* Background */
    /* Scenario */
    this.When('I enter the following text in first name: "$firstName"', function(firstName, callback){
        this.browser.fill('firstname', firstName);
        callback();
    });
    
    this.When('I enter the following text in last name: "$lastName"', function(lastName, callback){
        this.browser.fill('lastname', lastName);
        callback();
    });
    
    this.When('I click on submit', function(callback){
        this.browser.pressButton('button', callback); 
    });
    
    this.Then('I should see "$message"', function(message, callback){
        var text = this.browser.text('div.alert-success');
        
        if(text === message){
            callback();
        }else{
            callback.fail('Expected: ' + message + ' Actual: ' + text);   
        }
    });
    /* Scenario */
    this.When('I enter the following text in first name: "$invalidFirstName"', function(invalidFirstName, callback){
        this.browser.fill('firstname', invalidFirstName);
        callback();
    });
    
    this.When('I enter the following text in last name: "$invalidLastName"', function(invalidLastName, callback){
        this.browser.fill('lastname', invalidLastName);
        callback();
    });
    
    this.When('I click on submit', function(callback){
        this.browser.pressButton('button', callback); 
    });
    
    this.Then('I should see an error alert', function(callback){
        if(this.browser.query('div.alert-error')){
            callback();
        }else{
            callback.fail('No error alert found');   
        }
    });
    /* Scenario */
};