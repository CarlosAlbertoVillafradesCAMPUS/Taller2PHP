<?php
header("Content-Type:application/json");

$_DATA = json_decode(file_get_contents("php://input"), true);

$_METHOD = $_SERVER["REQUEST_METHOD"];
var_dump($_METHOD);

function cantTotal(float $cantidad, float $precio){
    return $cantidad * $precio;
}

function factura($arg){
    if (is_numeric($arg["nomProducto"]) || !is_numeric($arg["preArticulo"]) || !is_numeric($arg["canArticulo"])) {
        return(array)[
            "Nombre" => "Error!!",
            "Cantidad" => "Error!!",
            "Valor" => "Error!!",
            "Total" => "Error!!"
        ];
    }else{ 
        return(array)[
            "Nombre" => $arg["nomProducto"],
            "Cantidad" => $arg["canArticulo"],
            "Valor" => $arg["preArticulo"],
            "Total" => cantTotal($arg["canArticulo"],$arg["preArticulo"])
        ];
    } 
}

try {
    $res = match($_METHOD){
        "POST" => factura($_DATA),
        default => <<<STRING
        Methodo "${_METHOD}" imposible de ejecutar, rectifique su methodo
        STRING
    };
} catch (\Throwable $th) {
    $res = (array)[
        "Nombre" => "Error!!",
        "Cantidad" => "Error!!",
        "Valor" => "Error!!",
        "Total" => "Error!!"
    ];
}

    $respuesta = (array) [
        "NombreProducto" => $res["Nombre"],
        "CantidadProducto" => $res["Cantidad"],
        "ValorProducto" => $res["Valor"],
        "TotalALlevar" => $res["Total"]
    ];

    echo json_encode($respuesta, JSON_PRETTY_PRINT);
?>