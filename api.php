<?php
header("Content-Type:application/json");

$_DATA = json_decode(file_get_contents("php://input"), true);
$_METHOD = $_SERVER["REQUEST_METHOD"];
var_dump($_METHOD);

function calcVoltaje(float $resistencia, float $intencidad){
    return $resistencia * $intencidad;    
}

try {
    $res = match($_METHOD){
        "POST" => calcVoltaje(...$_DATA),
        default => <<<STRING
        Methodo "${_METHOD}" imposible de ejecutar, rectifique su methodo
        STRING
    };
} catch (\Throwable $th) {
    $res = "Error";
}

$respuesta = (array) [
    "data" => $_DATA,
    "voltaje" => $res
];

echo json_encode($respuesta, JSON_PRETTY_PRINT);
?>