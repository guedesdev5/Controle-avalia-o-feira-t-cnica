<?php
include "modelo/trabalho.php";
$resposta = array();
$cliente = new Cliente();
$clientes = $cliente->listarALFA();
header("HTTP/1.1 200 OK");
echo json_encode($clientes);
?>