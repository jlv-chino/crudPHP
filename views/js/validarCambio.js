//VALIDAR REGISTRO
function validarCambio(){

    let usuario = document.querySelector("#usuarioEditar").value;
    let password = document.querySelector("#passwordEditar").value;
    let email = document.querySelector("#emailEditar").value;

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

    return true;

}