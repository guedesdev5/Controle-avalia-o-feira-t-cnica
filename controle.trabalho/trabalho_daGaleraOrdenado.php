<?php
include "modelo/trabalhoA.php";
$resposta = array();
$cliente = new classe();
$clientes = $cliente->listarOrdenados();
header("HTTP/1.1 200 OK");
echo json_encode($clientes);
?>