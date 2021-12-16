//VALIDAR USUARIO EXISTENTE CON AJAX
let usuarioExistente = false;

$("#usuarioRegistro").change(function(){

    let usuario = $("#usuarioRegistro").val();
    
    let datos = new FormData();
    datos.append("validarUsuario", usuario);

    $.ajax({
        url: "views/modules/ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
            if(respuesta == 'encontrado'){

                alert("Nombre de usuario ya existente en la DB!!!");

                usuarioExistente = true;

            }
        }
    });

});

//VALIDAR EMAIL EXISTENTE CON AJAX
let emailExistente = false;

$("#emailRegistro").change(function(){

    let email = $("#emailRegistro").val();
    
    let datos = new FormData();
    datos.append("validarEmail", email);

    $.ajax({
        url: "views/modules/ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
            if(respuesta == 'encontrado'){

                alert("Email ya existente en la DB!!!");

                emailExistente = true;

            }
        }
    });

});

//VALIDAR REGISTRO
function validarRegistro(){

    let usuario = document.querySelector("#usuarioRegistro").value;
    let password = document.querySelector("#passwordRegistro").value;
    let email = document.querySelector("#emailRegistro").value;
    let terminos = document.querySelector("#terminos").checked;

    let expresionRegular = /^[a-zA-Z0-9]+$/; 
    
    //VALIDAR USUARIO
    if(usuario != "" && usuario.length > 6){

        alert("Escriba menos de 6 caracteres en el campo nombre");
        
        return false;

    }
    
    if(!expresionRegular.test(usuario)){

        alert("El campo nombre contiene caracteres especiales");
        
        return false;      

    }

    if(usuarioExistente){

        alert("Nombre de usuario ya existente en la DB!!!");

        return false;

    }

    //VALIDAR PASSWORD
    if(password != "" && password.length < 5){

        alert("Escriba un mínimo de 6 caracteres en el campo password");
        
        return false;

    }
    
    if(!expresionRegular.test(password)){

        alert("El campo password contiene caracteres especiales");
        
        return false;      

    }

    //VALIDAR EMAIL
    if(email != ""){

        let expresionEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

        if(!expresionEmail.test(email)){

            alert("Escriba su email correctamente");
            
            return false;      
    
        }
    
        if(emailExistente){
    
            alert("Email ya existente en la DB!!!");
    
            return false;
    
        }

    }
    

    //VALIDAR TERMINOS
    if(!terminos){

        alert("Acepte términos y condiciones para finalizar el registro");

        return false;  

    }

    return true;

}