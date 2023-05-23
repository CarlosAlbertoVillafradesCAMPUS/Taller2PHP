<?php
header("Content-Type:application/json");

$_DATA = json_decode(file_get_contents("php://input"), true);

$_METHOD = $_SERVER["REQUEST_METHOD"];
var_dump($_METHOD);

function calcCuadrado($arg){
    if (is_numeric($arg["valLadoCuadrado"])) {
        $lado = (float) $arg["valLadoCuadrado"];

        return (array) [
            "perimetro"=> ($lado * 4)
        ];
    }else{
        return (array) [
            "perimetro"=> "Error!!"
        ];
    }
}

function calcRectangulo($arg){
    if (is_numeric($arg["baseRectangulo"]) && is_numeric($arg["alturaRectangulo"])) {
        $base = (float) $arg["baseRectangulo"];
        $altura = (float) $arg["alturaRectangulo"];

        return (array) [
            "area"=> ($base * $altura)
        ];
    } else{
        return (array) [
            "area"=> "Error!!"
        ];
    }
}

function ValidateForm($arg){
    return ($arg["valLadoCuadrado"]) ?calcCuadrado($arg) :calcRectangulo($arg);
}

try {
    $res = match($_METHOD){
        "POST" => ValidateForm($_DATA),
        default => <<<STRING
        Methodo "${_METHOD}" imposible de ejecutar, rectifique su methodo
        STRING
    };
} catch (\Throwable $th) {
    $res = (array)[
        "perimetro" => "Error!!",
        "area" => "Error!!",
    ];
}

if($res["perimetro"]){
    $respuesta = (array) [
        "data" => $_DATA,
        "perimetroCuadrado" => $res["perimetro"]
    ];
}else{
    $respuesta = (array) [
        "data" => $_DATA,
        "areaRectangulo" => $res["area"]
    ];
}
   

    echo json_encode($respuesta, JSON_PRETTY_PRINT);
?>