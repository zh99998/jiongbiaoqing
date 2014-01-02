var FirefoxFileUpload=function(url,dataName){
    this.xhr=new XMLHttpRequest();
    
    this.__file=null;
    this.__fileReader=new FileReader();
    this.__url=url;
    this.__dataName=dataName || "FileData";
    
    this.__initReader();
};
FirefoxFileUpload.prototype={
    upload:function(file){
        if(!file){
            return;
        }
        
        this.__file=file;
        this.__fileReader.readAsBinaryString(this.__file);
    },
    
    getFile:function(e){
        return e.dataTransfer.files[0];
    },
    
    __send:function(){
        var xhr=this.xhr,
            boundary="----------BOUNDARY"+(new Date()).getTime(),
            body=this.__getBody(this.__fileReader.result,boundary);
        
        xhr.open("post",this.__url,true);
        xhr.setRequestHeader("Content-Type","multipart/form-data, boundary="+boundary);
        xhr.setRequestHeader("Content-Length",this.__file.size);

        xhr.sendAsBinary(body);
    },
    
    __initReader:function(){
        var me=this;
        this.__fileReader.addEventListener("load",function(){
            me.__send();
        },false);
    },
    
    __getBody:function(readerResult,boundary){
        return ['--',boundary,'\r\n',
                'content-disposition: form-data; name="',this.__dataName,'"; filename="',encodeURI(this.__file.name),'"\r\n',
                'Content-Type: ',this.__file.type,'\r\n\r\n',
                 readerResult,"\r\n",
                '--',boundary,'--\r\n'
            ].join("");
    }
    
};

var ChromeFileUpload=function(url,dataName){
    this.xhr=google.gears.factory.create("beta.httprequest");
    
    this.__url=url;
    this.__file=null;
    this.__builder=google.gears.factory.create("beta.blobbuilder");
    this.__dataName=dataName || "FileData";
};
ChromeFileUpload.prototype={
    upload:function(file){
        this.__file=file;
        this.__send();
    },
    
    getFile:function(e){
        var desktop=google.gears.factory.create("beta.desktop");
        return desktop.getDragData(e,"application/x-gears-files").files[0];
    },
    
    __send:function(){
        var xhr=this.xhr,
            boundary="----------BOUNDARY"+(new Date()).getTime();
        
        xhr.open("post",this.__url,true);
        xhr.setRequestHeader("Content-Type","multipart/form-data, boundary="+boundary);
        
        this.__updateBuilder(boundary);
        xhr.send(this.__builder.getAsBlob());
    },
    
    __updateBuilder:function(boundary){
        var bdr=this.__builder;
        
        bdr.append(['--',boundary,'\r\n',
                    'content-disposition: form-data; name="',this.__dataName,'"; filename="',encodeURI(this.__file.name),'"\r\n',
                    'Content-Type: ',this.__file.type,'\r\n\r\n'].join(""));
        bdr.append(this.__file.blob);
        bdr.append(["\r\n",
                    '--',boundary,'--\r\n'
                    ].join(""));
    }
};