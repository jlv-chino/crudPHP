//VALIDAR REGISTRO
function validarRegistro(){

    let usuario = document.querySelector("#usuarioRegistro").value;
    let password = document.querySelector("#passwordRegistro").value;
    let email = document.querySelector("#emailRegistro").value;

    let expresionRegular = /^[a-zA-Z0-9]*$/;  
    
    //VALIDAR USUARIO
    if(usuario != "" && usuario.length > 6){

        alert("Escriba menos de 6 caracteres en el campo nombre");
        
        return false;

    }
    
    if(!expresionRegular.test(usuario)){

        alert("El campo nombre contiene caracteres especiales");
        
        return false;      

    }

    return true;

}