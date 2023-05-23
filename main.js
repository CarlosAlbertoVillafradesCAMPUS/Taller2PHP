//Dado un número indicar si es par o impar y si es mayor de 10.

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