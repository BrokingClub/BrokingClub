exports.create = function(){
    return new Timer();
};

function Timer(){
    this.start = function(){
        this.startTime = Date.now();
    };
    
    this.stop = function(message){
        var stopTime = Date.now();
        var timeDiff = stopTime - this.startTime;
        
        console.log(message + ' (' + timeDiff + 'ms)');
    };
}