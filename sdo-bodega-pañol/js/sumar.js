

let boton = document.getElementById('sumar');
let res = document.getElementById('total');

const numeroIngresar = document.getElementById('numeroIngresar');
numeroIngresar.focus()

boton.addEventListener('click', añadir);

 function añadir(){

    let n1 = parseInt(document.getElementById('cantidadHerramienta').value);
    let n2 = parseInt(document.getElementById('numeroIngresar').value);

     
    let total = n1 + n2;

    res.value = total;
 }




// function añadir() {

//     var nuevaCantidad = 0;
  
//     $(".numeroIngresar") && $(".cantidadHerramienta").each(function() {
  
//       if (isNaN(parseFloat($(this).val())  && isNaN(parseFloat($(this).val())))){
  
//         nuevaCantidad += 0;
  
//       } else {
  
//         nuevaCantidad += parseFloat($(this).val());
  
//       }
  
//     });
  
//     //alert(total);
//     document.getElementById('nuevaCantidad').innerHTML = nuevaCantidad;
  
// }



