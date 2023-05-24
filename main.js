/* Construir el algoritmo que lea por teclado dos números,
si el primero es mayor al segundo informar su suma y
diferencia, en caso contrario, informar el producto y la
división del primero respecto al segundo. */

let myForm = document.querySelector("#myForm");
let data = [];

myForm.addEventListener("submit", (e) =>{
    e.preventDefault();
    let guardarDatos = Object.fromEntries(new FormData(e.target));
    
    if(guardarDatos.cantidadAtletas == ""){
        alert("Por favor llenar los campos");
    } else {
        if(isNaN(guardarDatos.cantidadAtletas)){
            alert("escriba bien carechimba")
        } else{
            let cantidadAtletas = guardarDatos.cantidadAtletas;

            let fielset = document.querySelector("fieldset")
            fielset.innerHTML = null;
            fielset.insertAdjacentHTML("beforeend", `
                                                    <legend>Formulario atletas</legend>
                                                        <form id="myForm2">
                                                            <label for="">Digite el nombre de la atleta</label><br>
                                                            <input type="text" name="nombreAtleta" id="nombreAtleta" required> <br><br>
    
                                                            <label for="">Digite la marca en saltos de la atleta</label><br>
                                                            <input type="text" required pattern="[0-9.]+" name="marcaSalto" id="marcaSalto" required> <br><br>
                                                        
                                                            <input type="submit" id="submit" value="Guardar"><br><br>
                                                            <input type="button" id="btnMostrar" value="Mostrar"><br><br>
                                                        </form>
                                                    `);
                formularioAtletas(cantidadAtletas);
        }
       
    }
})

function formularioAtletas(arg){
    let myForm2 = document.querySelector("#myForm2")
    let record = 15.50;
    myForm2.addEventListener("submit", async(e) =>{
        e.preventDefault();
        let guardarAtletas = Object.fromEntries(new FormData(e.target));

        if(guardarAtletas.nombreAtleta == "" || guardarAtletas.marcaSalto == ""){
            alert("Error!! Porfavor llenar los campos");
        }else{
            if(data.length <= (parseInt(arg)-1)){
                if(guardarAtletas.marcaSalto > record){
                    alert(`Felicitaciones ${guardarAtletas.nombreAtleta} acabas de romper el record de  ${record}m con una marca de ${guardarAtletas.marcaSalto}`);
                    record = guardarAtletas.marcaSalto;
                    guardarAtletas.recompensa = 500000000;
                }
                data.push(guardarAtletas);
                if(data.length == arg){
                    document.querySelector("#submit").setAttribute("disabled", ""); 
                }
                
            }else{
                alert("Cantidad de atletas alcanzada");
            }
        }
        console.log(data);
        myForm2.reset();
    })

    document.querySelector("#btnMostrar").addEventListener("click", async(e) =>{
        let config = {
            method: "POST",
            header: {"Content-Type":"application/json"},
            body: JSON.stringify(data)
        }
        let res = await( await fetch("api.php", config)).text();
        document.querySelector("pre").innerHTML = res;
    })
}