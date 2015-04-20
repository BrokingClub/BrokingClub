module.exports = function(err, res){
    if(err){
        console.error(err);
        
        if(res){
            res.sendStatus(500);   
        }
        
        return false;
    }else{
        return true;
    }
};