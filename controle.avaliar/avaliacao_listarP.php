<?php
include "modelo/avaliacao.php";
$resposta = array();
$cliente = new Cliente();
$clientes = $cliente->listar();
header("HTTP/1.1 200 OK");
echo json_encode($clientes);
?>