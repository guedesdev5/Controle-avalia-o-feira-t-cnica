<?php
include "modelo/trabalho.php";
$resposta = array();
$jsonRecebido = file_get_contents('php://input');


$obj = json_decode($jsonRecebido);


$nome = strip_tags($obj->nome);
$resumo = strip_tags($obj->resumo);
$idcurso = strip_tags($obj->idcurso);

if ($nome == "") {
    $resposta['cod'] = "erro";
    $resposta['msg'] = "Nome não preenchido";

} else {
  
    $cliente = new Cliente();

    $cliente->setNome($nome);
    $cliente->setresumo($resumo);
    $cliente->setidcurso($idcurso);

    $resultado = $cliente->cadastrar();

    if ($resultado == true) {
        header('HTTP/1.1 201 Created');
        $resposta['cod'] = "ok";
        $resposta['msg'] = "cadastrado com sucesso";
        $resposta['Trabalho'] = $cliente;
    } else {
        header('HTTP/1.1 200 ok');
        $resposta['cod'] = "erro";
        $resposta['msg'] = "Não foi cadastrado";
    }
}

echo json_encode($resposta);

?>