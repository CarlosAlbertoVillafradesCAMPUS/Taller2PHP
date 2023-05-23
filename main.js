// Construir el algoritmo que solicite el nombre y edad de 3
// personas y determine el nombre de la persona con mayor edad.

let myForm = document.querySelector("#myForm");
let data = [];

myForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const dataForm = Object.fromEntries(new FormData(e.target));
    if(data.length <= 2){
        data.unshift(dataForm);
        alert(dataForm.nombre + " agregado con exito");
        document.querySelector("#btnContinuar").removeAttribute("disabled");
        myForm.reset();
        if(data.length == 3){
            document.querySelector("#submit").setAttribute("disabled","");
        }     
    }else{
        alert("Ya haz agregado las 3 personas");
        document.querySelector("#submit").setAttribute("disabled","");
        myForm.reset();
    }
    
});

document.querySelector("#btnContinuar").addEventListener("click", async(e) => {
    let config = {
        method: "POST",
        header: {"Content-Type":"application/json"},
        body: JSON.stringify(data)
    }
    let res = await( await fetch("api.php", config)).text();
    document.querySelector("pre").innerHTML = res;
})

