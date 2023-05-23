/* Construir el algoritmo que lea por teclado dos números,
si el primero es mayor al segundo informar su suma y
diferencia, en caso contrario, informar el producto y la
división del primero respecto al segundo. */

let myFormCuadrado = document.querySelector("#myFormCuadrado");
let myFormRectangulo = document.querySelector("#myFormRectangulo");

myFormCuadrado.addEventListener("submit", async (e) => {
    e.preventDefault();
    const dataForm = Object.fromEntries(new FormData(e.target));
    if(dataForm.valLadoCuadrado == ""){
        alert("Error!! Porfavor llenar los campos");
    }else{
        let config = {
            method: "POST",
            header: {"Content-Type":"application/json"},
            body: JSON.stringify(dataForm)
        }
        let res = await( await fetch("api.php", config)).text();
        document.querySelector("pre").innerHTML = res; 
    }
});

myFormRectangulo.addEventListener("submit", async (e) => {
    e.preventDefault();
    const dataForm = Object.fromEntries(new FormData(e.target));
    if(dataForm.baseRectangulo == "" || dataForm.alturaRectangulo == ""){
        alert("Error!! Porfavor llenar los campos");
    }else{
        let config = {
            method: "POST",
            header: {"Content-Type":"application/json"},
            body: JSON.stringify(dataForm)
        }
        let res = await( await fetch("api.php", config)).text();
        document.querySelector("pre").innerHTML = res; 
    }
});