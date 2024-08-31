<?php
include "modelo/prof.php";

// cria um array para utilizar na resposta.
$resposta = array();

//recupera os dados(texto json) que vieram no corpo da requisicao.
$jsonRecebido = file_get_contents('php://input');

////converte os dados em um objeto json
$obj = json_decode($jsonRecebido);

$nome = strip_tags($obj->nome);

$nascimento = strip_tags($obj->nascimento);

$partesRota = explode("/", $_SERVER['REQUEST_URI']);
$idCliente = $partesRota[2];
//verifica se os dados foram preenchidos corretamente
//este exemplo é simples
//verifique conforme a necessidade da aplicação.
if ($nome == "") {
    $resposta['cod'] = "erro";
    $resposta['msg'] = "Nome não preenchido";
} else {

    $cliente = new Cliente();
    $cliente->setIdCliente($idCliente);
    $cliente->setNome($nome);
    $cliente->setNascimento($nascimento);
    $resultado = $cliente->atualizar();
    if ($resultado == true) {
        header("HTTP/1.1 200 OK");
        $resposta['cod'] = "ok";
        $resposta['msg'] = "Atualizado com sucesso";
        $resposta['PUT'] = $cliente;
    } else {
        header("HTTP/1.1 200 OK");
        $resposta['cod'] = "erro";
        $resposta['msg'] = "Não foi atualizado";
    }
}
//converte o array resposta em json para
//enviar de resposta ao cliente
echo json_encode($resposta);
