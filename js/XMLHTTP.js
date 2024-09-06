function XHR() {
    this.xhr = new XMLHttpRequest();
}

XHR.prototype.connect = function(method='GET',URL,value) {
    this.xhr.withCredentials = true;

    let url='http://localhost:3333/'+URL
    return new Promise((resolve)=>{
        this.xhr.open(method, url);
    if(method=='GET'){
        this.xhr.send();
    }
    else {
        this.xhr.setRequestHeader("Content-Type", "application/json");
        var data=JSON.stringify(value)
        this.xhr.send(data);
    }
    this.xhr.onload=() =>{
        resolve(JSON.parse(this.xhr.response))
    }
    })
    
};
