<?php
include "modelo/grupos.php";

// cria um array para utilizar na resposta.
$resposta = array();

//recupera os dados(texto json) que vieram no corpo da requisicao.
//exemplo de formato de dados:
    /* 
        {
            "nome": "zé",
            "email": "helioesperidiao@gmail.com",
            "nascimento": "1985-10-03",
            "salario": 1300
        }
     */
$jsonRecebido = file_get_contents('php://input');

//converte os dados em um objeto json
$obj = json_decode($jsonRecebido);

//strip_tags remove tags html dos dados vindos dos clientes
//impede isso: nome = <b>helio</b>
$idTrabalho = strip_tags($obj->idtrabalho);
$nomealuno = strip_tags($obj->nomeAluno);
$turma = strip_tags($obj->turmaAluno);
$matricula = strip_tags($obj->matricula);

//verifica se os dados foram preenchidos corretamente
//este exemplo é simples
//verifique conforme a necessidade da aplicação.
if ($nomealuno == "") {
    $resposta['cod'] = "erro";
    $resposta['msg'] = "Nome não preenchido";

} else {
    //após passar por todas as verificações
    $cliente = new Cliente();
    //passa os dados para o objeto
    $cliente->setNome($nomealuno);
    $cliente->setturma($turma);
    $cliente->setidtrabalho($idTrabalho);
    $cliente->setmatricula($matricula);

    //chama o método cadastrar
    $resultado = $cliente->cadastrar();

    if ($resultado == true) {
        header('HTTP/1.1 201 Created');
        $resposta['cod'] = "ok";
        $resposta['msg'] = "cadastrado com sucesso";
        $resposta['novoCliente'] = $cliente;
    } else {
        header('HTTP/1.1 200 ok');
        $resposta['cod'] = "erro";
        $resposta['msg'] = "Não foi cadastrado";
    }
}
//converte o array resposta em json para
//enviar de resposta ao cliente
echo json_encode($resposta);

?>