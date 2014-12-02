var no = require('app/no');

module.exports = function(){
    this.World = require('../support/world.js').World;
    
    /* Background */
    this.Given('I am logged in as a test user', function(callback){
        var browser = this.browser;
        
        this.visit('http://node.broking.club/test/login.html', function(err){
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
        this.browser.clickLink('Profile', callback);
    });
    /* Background */
    /* Scenario */
    this.When('I enter the following text in first name: "first_name"', function(firstName, callback){
        this.browser.fill('firstname', firstName);
        callback();
    });
    
    this.When('I enter the following text in last name: "last_name"', function(lastName, callback){
        this.browser.fill('lastname', lastName);
        callback();
    });
    
    this.Then('I should see "Profile has been updated"', function(message, callback){
        callback.pending();
    });
    /* Scenario */
    this.When('I enter the following text in first name: "%/&_not_a_valid_firstname:)"', function(invalidFirstName, callback){
        this.browser.fill('firstname', invalidFirstName);
        callback();
    });
    
    this.When('I enter the following text in last name: "&%not_a_valid_lastname(/"', function(invalidLastName, callback){
        this.browser.fill('lastname', invalidLastName);
        callback();
    });
    
    this.Then('I should see "Non valid input!"', function(callback){
        callback.pending();
    });
    /* Scenario */
};