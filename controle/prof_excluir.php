<?php
include "modelo/prof.php";
$resposta = array();

$partesRota = explode("/", $_SERVER['REQUEST_URI']);

$idCliente = $partesRota[2];

$cliente = new Cliente();

$cliente->setIdCliente($idCliente);

$resultado = $cliente->excluir();

if ($resultado == true) {
    $resposta['cod'] = "ok";
    $resposta['msg'] = "Excluido com sucesso";
    $resposta['DELETE'] = $cliente;
} else {
    $resposta['cod'] = "erro";
    $resposta['msg'] = "Não foi Excluido";
}

header("HTTP/1.1 200 Ok");
echo json_encode($resposta);

?>