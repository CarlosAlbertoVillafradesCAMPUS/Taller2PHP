// Construir el algoritmo para un programa que ingrese tres
// notas de un alumno, si el promedio es menor o igual a 3.9
// mostrar un mensaje "Estudie“, de lo contrario un mensaje que
// diga "becado"

let myForm = document.querySelector("#myForm");
myForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const dataForm = Object.fromEntries(new FormData(e.target));
    let config = {
        method: "POST",
        header: {"Content-Type":"application/json"},
        body: JSON.stringify(dataForm)
    }
    let res = await( await fetch("api.php", config)).text();
    document.querySelector("pre").innerHTML = res;
})