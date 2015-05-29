'use strict';

module.exports = function(app) {
    app.controller('CucumberController', require('./cucumber-controller'));
    app.controller('LinesOfCodeController', require('./lines-of-code-controller'));
};