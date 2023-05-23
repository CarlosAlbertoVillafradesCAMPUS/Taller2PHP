<?php
header("Content-Type:application/json");

$_DATA = json_decode(file_get_contents("php://input"), true);
$_METHOD = $_SERVER["REQUEST_METHOD"];
var_dump($_METHOD);

function calcPromedio(float $nota1, float $nota2, float $nota3){
        $promedio = ($nota1 + $nota2 + $nota3)/3;

        return (array)[
            "prom"=> $promedio,
            "mensaje"=> ($promedio >= 3.9) ?"Felicitaciones Aprobo" :"Pailas Reprobo"
        ];
}

try {
    $res = match($_METHOD){
        "POST" => calcPromedio(...$_DATA),
        default => <<<STRING
        Methodo "${_METHOD}" imposible de ejecutar, rectifique su methodo
        STRING,
    };
} catch (\Throwable $th) {
    $res = (array)[
        "prom"=> "Error",
        "mensaje"=> "Error"
    ];
}

if (is_array($res)){
    $resuesta = (array) [
        "message" =>$res["mensaje"],
        "data" => $_DATA,
        "promedio" => $res["prom"]
    ];

    echo json_encode($resuesta, JSON_PRETTY_PRINT);
} else{
    echo $res;
}


?>