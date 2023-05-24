<?php
    header("Content-Type:application/json");

    $_DATA = json_decode(file_get_contents("php://input"), true);

    $_METHOD = $_SERVER["REQUEST_METHOD"];
    var_dump($_METHOD);

    function atletaGanadora($arg){
        foreach ($arg as $value) {
           if(is_numeric($value["marcaSalto"]) && !is_numeric($value["nombreAtleta"])){
            $arrayMarcas = array_column($arg, "marcaSalto");
        $marcaGanadora = max($arrayMarcas);
        $position = array_search($marcaGanadora, $arrayMarcas);
        return $arg[$position];
           } else{
        return "Erro!!";
           }
        }
        
    }

    try {
        $res = match($_METHOD){
            "POST" => atletaGanadora($_DATA),
            default => <<<STRING
            Methodo "${_METHOD}" imposible de ejecutar, rectifique su methodo
            STRING
        };
    } catch (\Throwable $th) {
        $res = "Error!!";
    }

    $respuesta = (array)[
        "Ganadora"=> $res,
    ];

    echo json_encode($respuesta, JSON_PRETTY_PRINT);
?>