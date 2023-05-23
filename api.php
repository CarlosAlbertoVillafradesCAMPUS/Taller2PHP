<?php
header("Content-Type:application/json");

$_DATA = json_decode(file_get_contents("php://input"), true);
$_METHOD = $_SERVER["REQUEST_METHOD"];
var_dump($_METHOD);

function validateNumber(float $number){
    if(intval($number) == floatval($number)){
        $calculate = $number%2;
        return ($calculate == 0) ?"El numero $number es PAR." :"El numero $number es IMPAR.";
    } else {
        return "Error!! El dato ingresado es incorrecto";
    }     
}

try {
    $res = match($_METHOD){
        "POST" => validateNumber(...$_DATA),
        default => <<<STRING
        Methodo "${_METHOD}" imposible de ejecutar, rectifique su methodo
        STRING
    };
} catch (\Throwable $th) {
    $res = "Error!! El dato ingresado es incorrecto";
}

echo $res;
?>