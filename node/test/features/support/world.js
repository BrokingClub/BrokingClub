var zombie = require('zombie');
var WorldConstructor = function WorldConstructor(callback) {
  this.browser = new zombie();

  var world = {
    browser: new zombie(),
    visit: function(url, callback) {
      this.browser.visit(url, callback);
    }
  };

  callback(world);
};

exports.World = WorldConstructor;