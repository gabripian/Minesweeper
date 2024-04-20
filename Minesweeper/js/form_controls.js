//cliccando il tasto di registrazione si richiama la pagina do_check per controllare che i dati siano corretti 
//e che l'utente non sia già stato scelto 
$(document).ready(function(){    
    $("#form1").submit(function(e){
        //si blocca la sottomissione della form
        e.preventDefault();
        
        var nomeutente= $("#nomeutente").val();
        var email=  $("#email").val();
        var nazioni=  $("#nazioni").val();
        var Password=  $("#Password").val();

        
            $.ajax({
                type: "POST",
                url: "./php/do_check.php",
                data: {nomeutente: nomeutente, email: email, nazioni: nazioni, Password: Password},
                
                success: function(response){ 
                    //se il nome utente non è disponibile stampa il messaggio 
                    if( response === "Nome utente non disponibile"){

                        $("#results").text(response);
                        $("#results1").text("");

                    }else{$("#results").text("");} 
                    //se i dati sono validi, mostra la seguente scritta
                    if(response === "La registrazione è avvenuta con successo, puoi accedere!"){

                        $("#results1").text(response);
                        
                    }
                }

            });
        
    });
});
    
$(document).ready(function(){  
    $("#form2").submit(function(e) {
        
        e.preventDefault();
        
        var utente= $("#utente").val();
        var password=  $("#password").val();
    
        $.ajax({
            type: "POST",
            url: "./php/do_check.php",
            data: {utente: utente, password: password},

            success: function(response){ 
            //se nome utente è sbagliato mostra l'errore
            if( response === "Il nome utente è sbagliato!"){

                $("#results3").text("");
                $("#results2").text(response);
            //se la password è sbagliata mostra l'errore
            }else if(response === "La password è sbagliata!"){
                    
                    $("#results2").text("");
                    $("#results3").html(response);
            }else{
                 $("#results3").text("");
                 e.currentTarget.submit();                              //se non ci sono problemi sottometto la form
            }
        }

        });
        
       
    });
});
    
    
       

//controlli lato client sui dati immessi dall'utente    
function validateForm() {

    var fuori;
    var nomeUtente1 = document.forms["form1"]["nomeutente"].value;
    var patt1 = /^[a-zA-Z0-9_-]+$/;
    var result1 = nomeUtente1.match(patt1);

    if((result1===null) || (nomeUtente1.length <5 || nomeUtente1.length >20)){

        document.getElementById('error-name').style.color = "#ff6f61";
        fuori=1;

    }else{
        document.getElementById('error-name').style.color = "rgba(255, 255, 255, 0.5)";

    }

    var email1 = document.forms["form1"]["email"].value;
    var patt2 = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
    var result2=email1.match(patt2);

    if(result2===null){
        document.getElementById('error-name1').innerText = "Il formato della email non è valido";
        document.getElementById('error-name1').style.color = "#ff6f61";
        fuori=1;
    }else{
        document.getElementById('error-name1').style.color = "rgba(255, 255, 255, 0.5)";
        document.getElementById('error-name1').innerText =" ";

    }

    var password1 = document.forms["form1"]["Password"].value;
    var patt3 = /^[\S]+$/;
    var result3 = password1.match(patt3);

    if((result3===null) || (password1.length <5 || password1.length >20)){
        document.getElementById('error-name2').style.color = "#ff6f61";
        fuori=1;
    }else{
        document.getElementById('error-name2').style.color = "rgba(255, 255, 255, 0.5)";

    }

    if(fuori===1){
        return false;
    }

}