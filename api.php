<?php
header("Content-Type:application/json");

$_DATA = json_decode(file_get_contents("php://input"), true);
$_METHOD = $_SERVER["REQUEST_METHOD"];
var_dump($_METHOD);

function sumAndRest($numero1, $numero2){
    $sum = $numero1 + $numero2;
    $rest = $numero1 - $numero2;

    return (array)[
        "sum"=>$sum,
        "rest"=>$rest
    ];
}

function multAndDiv($numero1, $numero2){
    $mult = $numero2 * $numero1;
    $div = $numero2 / $numero1;

    return (array)[
        "mult"=>$mult,
        "div"=>$div
    ];
}

function calcNumber(float $numero1, float $numero2){
    if (!is_numeric($numero1) || !is_numeric($numero2) ) {
        return "Error!!";
    }else{
        return ($numero1 > $numero2) ?sumAndRest($numero1, $numero2) :multAndDiv($numero1, $numero2);
    }
}

try {
    $res = match($_METHOD){
        "POST" => calcNumber(...$_DATA),
        default => <<<STRING
        Methodo "${_METHOD}" imposible de ejecutar, rectifique su methodo
        STRING
    };
} catch (\Throwable $th) {
    $res = (array)[
        "sum"=>"Error!!",
        "rest"=>"Error!!",
    ];
}

if($res["sum"]){
    $respuesta = (array) [
        "data" => $_DATA,
        "suma" => $res["sum"],
        "resta" => $res["rest"],
    ];
}else{
    $respuesta = (array) [
        "data" => $_DATA,
        "mult" => $res["mult"],
        "div" => $res["div"],
    ];
}


echo json_encode($respuesta, JSON_PRETTY_PRINT);
?>