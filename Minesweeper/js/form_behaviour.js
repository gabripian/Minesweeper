
    function show(v){
        //scambia le classi in base al bottone premuto nel form di registrazione
        if(document.getElementById(v.target.id).getAttribute("class")==="button2"){
            //se il bottone premuto era grigio entra e controlla, se il bottone è accedi scambia la classe con registrati
             if(document.getElementById(v.target.id).getAttribute("id")==="accedi"){
                 
                 document.getElementById("login").setAttribute("class", " ");
                 document.getElementById("signup").setAttribute("class", "tab-content");
                 document.getElementById(v.target.id).setAttribute("class", "button1");
                 document.getElementById("registrati").setAttribute("class", "button2");
                //se il bottonepremuto disattivato era registrati sacmbia le classi 
             }else if(document.getElementById(v.target.id).getAttribute("id")==="registrati"){
                 
                 document.getElementById("signup").setAttribute("class", " ");
                 document.getElementById("login").setAttribute("class", "tab-content");
                 document.getElementById(v.target.id).setAttribute("class", "button1");
                 document.getElementById("accedi").setAttribute("class", "button2");
                      
             }
                  
        }
             
    }
    //sposta la label del campo di input se ci si scrive sopra      
    function translate1(v){
              
        var ide=document.getElementById(v.target.id).getAttribute("id");
        
        ide=ide+"1";
        
        if(document.getElementById(v.target.id).value!==""){
            
            document.getElementById(ide).setAttribute("class", "label-active");
                
        }else{
            document.getElementById(ide).setAttribute("class", "");
                  
        }      
              
    }