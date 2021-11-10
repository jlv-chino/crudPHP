//VALIDAR REGISTRO
function validarRegistro(){

    let usuario = document.querySelector("#usuarioRegistro").value;
    let password = document.querySelector("#passwordRegistro").value;
    let email = document.querySelector("#emailRegistro").value;
    let terminos = document.querySelector("#terminos").checked;

    let expresionRegular = /^[a-zA-Z0-9]+$/; 
    let expresionEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
  
    //VALIDAR USUARIO
    if(usuario != "" && usuario.length > 6){

        alert("Escriba menos de 6 caracteres en el campo nombre");
        
        return false;

    }
    
    if(!expresionRegular.test(usuario)){

        alert("El campo nombre contiene caracteres especiales");
        
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
    if(!expresionEmail.test(email)){

        alert("Escriba su email correctamente");
        
        return false;      

    }

    //VALIDAR TERMINOS
    if(!terminos){

        alert("Acepte términos y condiciones para finalizar el registro");

        return false;  

    }

    return true;

}