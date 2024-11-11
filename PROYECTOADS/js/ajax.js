const formularios_ajax=document.querySelectorAll(".FormularioAjax");

/* 
*/ 
function enviar_formulario_ajax(e){
    e.preventDefault();

    let enviar=confirm("Quieres enviar el formulario");

    if(enviar==true){
            /*creamos datos a apartir del formulario */
        let data= new FormData(this);
        /*va a guardar el metodo del formulario */
        let method=this.getAttribute("method");
        let action=this.getAttribute("action");

        let encabezados= new Headers();

        let config={
            method: method,
            headers: encabezados,
            mode: 'cors',
            cache: 'no-cache',
            body: data
        };
  /*primero usamos el url del fomrulario que es action, configuraciones en config*/
        fetch(action,config)
        .then(respuesta => respuesta.text())
        .then(respuesta =>{ 
            let contenedor=document.querySelector(".form-rest");
            contenedor.innerHTML = respuesta;
        });
    }

}

/*cuando un formularion que contenga la clase vamos a ejecutar la funcion anterior */
formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit",enviar_formulario_ajax);
});