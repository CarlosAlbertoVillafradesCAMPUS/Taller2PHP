<?php
header("Content-Type:application/json");

$_DATA = json_decode(file_get_contents("php://input"), true);

$_METHOD = $_SERVER["REQUEST_METHOD"];
var_dump($_METHOD);

function calcMayorNota($arg){
        $arrayNotas = [];
        $cantidadHombres= (int) 0;
        $cantidadMujeres= (int) 0;
        for ($i=0; $i < count($arg) ; $i++) { 
            if (!is_string($arg[$i]["nombre"]) || !is_numeric($arg[$i]["nota"])) {
                return(array)[
                    "Maxima" => "Error!!",
                    "Minima" => "Error!!",
                    "cantHombres" => "Error!!",
                    "cantMujeres" => "Error!!"
                ];
                break;
            }else{ 
                $nota = (float)$arg[$i]["nota"];
                array_push($arrayNotas, $nota);
                
                if ($arg[$i]["sexo"] == "M") {
                    $cantidadHombres++;
                } else {
                    $cantidadMujeres++;
                }
            } 
        }
        $notaMaxima = max($arrayNotas);
        $notaMinima = min($arrayNotas);
        $positionNotaMenor = array_search($notaMinima, $arrayNotas);
        $positionNotaMayor = array_search($notaMaxima, $arrayNotas);
        var_dump($cantidadHombres);

        return(array)[
            "Maxima" => $arg[$positionNotaMayor],
            "Minima" => $arg[$positionNotaMenor],
            "cantHombres" => $cantidadHombres,
            "cantMujeres" => $cantidadMujeres
        ];
}

try {
    $res = match($_METHOD){
        "POST" => calcMayorNota($_DATA),
        default => <<<STRING
        Methodo "${_METHOD}" imposible de ejecutar, rectifique su methodo
        STRING
    };
} catch (\Throwable $th) {
    $res = (array)[
        "Maxima" => "Error!!",
        "Minima" => "Error!!",
        "cantHombres" => "Error!!",
        "cantMujeres" => "Error!!"
    ];
}


    $respuesta = (array) [
        "notaMaxima" => $res["Maxima"],
        "notaMinima" => $res["Minima"],
        "cantidadHombres" => $res["cantHombres"],
        "cantidadMujeres" => $res["cantMujeres"]
    ];

    echo json_encode($respuesta, JSON_PRETTY_PRINT);
?>