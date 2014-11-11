module.exports = function () {
  this.World = require("../support/world.js").World;

  this.Given(/^I am on the Broking Club documentation page$/, function(callback) {
    this.visit('http://broking.club/doc', callback);
  });

  this.Then('I should see "$title" as the page title', function(title, callback) {
    var pageTitle = this.browser.text('title');
	
    if (title === pageTitle) {
	  callback();
    } else {
      callback.fail("Expected to be on page with title " + title + ", got " + pageTitle);
    }
  });
};