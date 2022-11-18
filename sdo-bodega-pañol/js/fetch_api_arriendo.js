//IDENTIDICAR EL FORMULARIO
var formulario = document.getElementById("formulario1");

formulario.addEventListener('submit', function(e){

    e.preventDefault();
    console.log("me diste un click");

    var datos = new FormData(formulario);

    console.log(datos);
    console.log(datos.get('id'));
    console.log(datos.get('btnAccion'));

    fetch('carritoHerramientas.php',{

        method: 'POST',
        body: datos
    })
        


})

