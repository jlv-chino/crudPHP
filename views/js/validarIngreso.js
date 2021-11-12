//VALIDAR INGRESO
function validarIngreso(){

    let usuario = document.querySelector("#usuarioIngreso").value;
    let password = document.querySelector("#passwordIngreso").value;

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

    return true;

}