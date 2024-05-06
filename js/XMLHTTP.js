function XHR() {
    this.xhr = new XMLHttpRequest();
}

XHR.prototype.connect = function(method='GET',URL,value) {
    return new Promise((resolve)=>{
        this.xhr.open(method, URL);
    if(method=='GET'){
        this.xhr.send();
    }
    else {
        this.xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data=JSON.stringify(value)
        this.xhr.send("dataJSON="+data);
    }
    this.xhr.onload=() =>{
        resolve(this.xhr.responseText)
    }
    })
    
};
