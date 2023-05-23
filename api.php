<?php
header("Content-Type:application/json");

$_DATA = json_decode(file_get_contents("php://input"), true);
$_METHOD = $_SERVER["REQUEST_METHOD"];
var_dump($_METHOD);

function calcMayor($arg){
    if(count($arg) > 0 && count($arg) <= 3){
        $position = (int) 0;
        $sum = (int) 0;
        $i = (int) 0;
        foreach($arg as $key) {
            if (!is_numeric($key["edad"])) {
                return "Error!!";
                break;
                }
            $edad = (int) $key["edad"];
            if ($edad >= $sum) {
                $sum = $edad;
                $position = $i;
                $i++;
            }
            return $arg[$position];
        }
} else{
    return "Error!!";
}
}

try {
    $res = match($_METHOD){
        "POST" => calcMayor($_DATA),
        default => <<<STRING
        Methodo "${_METHOD}" imposible de ejecutar, rectifique su methodo
        STRING
    };
} catch (\Throwable $th) {
    $res = "Error!!";
}

$respuesta = (array) [
    "data" => $_DATA,
    "personaMayor" => $res
];

echo json_encode($respuesta, JSON_PRETTY_PRINT);
?>