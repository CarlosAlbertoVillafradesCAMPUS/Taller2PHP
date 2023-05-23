/* Construir el algoritmo que lea por teclado dos números,
si el primero es mayor al segundo informar su suma y
diferencia, en caso contrario, informar el producto y la
división del primero respecto al segundo. */

let myForm = document.querySelector("#myForm");
let data = [];

myForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const dataForm = Object.fromEntries(new FormData(e.target));
    if(dataForm.numeroTotal == ""){
        alert("Error!! Porfavor llenar los campos");
    }else{
        let datoCantidadEstudiantes = dataForm.numeroTotal;
        
        let fieldset = document.querySelector("fieldset")
        fieldset.innerHTML = null;
        fieldset.insertAdjacentHTML("beforeend", `
                                                    <legend>Ejercicio 5</legend>
                                                        <form id="myForm2">
                                                            <label for="nombre">Ingrese el nombre del estudiantes: </label>
                                                            <input id="nombre" type="text" name="nombre"/><br><br>
                                                            
                                                            <label for="nombre">Sexo del estudiante: </label>
                                                            <select name="sexo">
                                                                <option value="M">Masculino</option>
                                                                <option value="F">Femenino</option>
                                                            </select><br><br>

                                                            <label for="nota">Ingrese la nota de estudiantes: </label>
                                                            <input id="nota" type="number" name="nota"/><br>
                                                            
                                                            <input id="submit" type="submit" value="Agregar">
                                                            <input id="botonCalcular" type="button" value="Calcular">
                                                        </form>
                                                  `);
        formularioEstudiantes(datoCantidadEstudiantes);                                
        
    }
});

function formularioEstudiantes(arg){
    let myForm2 = document.querySelector("#myForm2");
    myForm2.addEventListener("submit", async(e) =>{
        e.preventDefault();
        const dataForm = Object.fromEntries(new FormData(e.target)); 

        if(dataForm.nombre == "" || dataForm.nota == ""){
            alert("Error!! Porfavor llenar los campos");
        }else{
            if(data.length <= (parseInt(arg)-1)){
                data.push(dataForm);
                if(data.length == arg){
                    document.querySelector("#submit").setAttribute("disabled", "");
                }
            }else{
                alert("Cantidad de estudiantes alcanzada");
                
            }
        }
        myForm2.reset();
    })

    document.querySelector("#botonCalcular").addEventListener("click", async(e) =>{
        console.log(data);
        let config = {
            method: "POST",
            header: {"Content-Type":"application/json"},
            body: JSON.stringify(data)
        }
        let res = await( await fetch("api.php", config)).text();
        document.querySelector("pre").innerHTML = res;
    })
}



