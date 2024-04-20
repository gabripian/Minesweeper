<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="it">
    <head>
        <title>Prato Fiorito</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="shortcut icon" href="#">
        <link rel="stylesheet" href="./CSS/register.css">
        <link rel="stylesheet" href="./CSS/documentation.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="./js/form_controls.js"></script> 
        <script src="./js/form_behaviour.js"></script> 
           
    </head>
    
    <body>
        <a class="doc" href="./documentazione.html">Documentazione</a>
        <h1 class="head">PRATO FIORITO</h1>
       
        <div class="form">
      
            <div class="tab-group">
                <a class="button1" id="registrati" onclick="show(event)" href="#signup">Registrati</a>
                <a class="button2" id="accedi" onclick="show(event)"  href="#login">Accedi</a>

            </div>
            
            <div>
                <div id="signup">   
                    <h1>Registrati gratis adesso!</h1>

                    <form id="form1" name="form1" action="/" method="post"  onsubmit="return validateForm()">


                        <div class="field-wrap">
                            <span class="error" id="error-name">Nome utente ammette cifre, lettere e underscore in un range di [5-20] caratteri</span><br>
                            <label id="nomeutente1">
                                Nome Utente<span class="req">*</span>
                            </label>  
                            <input id="nomeutente"  name="nomeutente" type="text" required autocomplete="off" onkeyup="translate1(event)"  oninvalid="this.setCustomValidity('Inserisci un nome utente')"
                            oninput="setCustomValidity('')"/>


                            <div class="taken" id="results"></div>

                        </div>

                        <div class="field-wrap">
                            <span class="error" id="error-name1"></span><br>
                            <label id="email1">
                                Email<span class="req">*</span>
                            </label> 
                            <input id="email" name="email" type="email" required autocomplete="off" onkeyup="translate1(event)" oninvalid="this.setCustomValidity('Inserisci una email valida')"
                            oninput="setCustomValidity('')"/>
                        </div>

                        <div class="field-wrap">

                            <label id="nazioni1">
                                Nazione<span class="req">*</span>
                            </label> 
                            <select  id="nazioni" name="nazioni" oninput="translate1(event), setCustomValidity('')" required oninvalid="this.setCustomValidity('Seleziona una nazione')" >
                                <option  label=" "></option>       
                                <option value="Italia" class="option1">Italia</option>
                                <option value="England" class="option1">England</option>
                                <option value="Deutschland" class="option1">Deutschland</option>
                                <option value="Portugal" class="option1">Portugal</option>
                                <option value="Belgium" class="option1">Belgique</option>
                                <option value="France" class="option1">France</option>
                             <option value="Netherland" class="option1">Holland</option>
                            </select>
                            <div class="select-icon">
                                <svg viewBox="0 0 104 128" width="25" height="35" class="icon">
                                    <path d="m2e1 95a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm0-3e1a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm0-3e1a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm14 55h68v1e1h-68zm0-3e1h68v1e1h-68zm0-3e1h68v1e1h-68z"></path>
                                </svg>
                            </div>       
                        </div>

                        <div class="field-wrap">
                            <span class="error" id="error-name2">Password non ammette spazi bianchi, ha un range di [5-20] caratteri</span><br>
                            <label id="Password1">
                                Password<span class="req">*</span>
                            </label> 
                            <input id="Password" name="Password" type="password" required autocomplete="off" onkeyup="translate1(event)" oninvalid="this.setCustomValidity('Inserisci una password')" oninput="setCustomValidity('')"/>
                        </div>

                        <button type="submit" id="up" class="button button-block">Registrati!</button><br>
                        <p class="req required">Questo campo è obbligatorio *</p>
                    </form>

                </div>

                <div id="login" class="tab-content">   
                    <h1>Bentornato!</h1>

                    <form id="form2" name="form2" action="./php/authenticate.php" method="post">

                        <div class="field-wrap">
                            <span class="error1" id="results2"></span><br>
                            <label id="utente1">
                                Nome utente<span class="req">*</span>
                            </label>
                            <input id="utente" name="utente" type="text" required autocomplete="off"  onkeyup="translate1(event)" oninvalid="this.setCustomValidity('Inserisci un nome utente')"
                            oninput="setCustomValidity('')"/>
                        </div>

                        <div class="field-wrap">
                            <span class="error1" id="results3"></span><br>    
                            <label id="password1">
                                Password<span class="req">*</span>
                            </label>
                            <input id="password" name="password" type="password" required autocomplete="off"  onkeyup="translate1(event)" oninvalid="this.setCustomValidity('Inserisci una password')" oninput="setCustomValidity('')"/>
                        </div>



                        <button class="button button-block">Accedi</button><br>
                        <p class="req required">Questo campo è obbligatorio *</p>
                    </form>

                </div>

            </div><!-- tab-content -->

        </div> <!-- /form -->

        <div class="access" id="results1"></div>

     

    </body>
</html>
