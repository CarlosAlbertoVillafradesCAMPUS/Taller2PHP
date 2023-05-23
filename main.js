//Construir el algoritmo para determinar el voltaje de un
//circuito a partir de la resistencia y la intensidad de corriente.

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