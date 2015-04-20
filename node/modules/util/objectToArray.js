module.exports = function(obj){
    var arr = [];

    Object.keys(obj).map(function(key){
        arr.push(obj[key]);
    });

    return arr;
};