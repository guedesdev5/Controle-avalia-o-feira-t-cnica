<?php
include "modelo/prof.php";

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
$idCliente = strip_tags($obj->registro);
$nome = strip_tags($obj->nome);
$nascimento = strip_tags($obj->nascimento);
//verifica se os dados foram preenchidos corretamente
//este exemplo é simples
//verifique conforme a necessidade da aplicação.
if ($nome == "") {
    $resposta['cod'] = "erro";
    $resposta['msg'] = "Nome não preenchido";

} else {
    //após passar por todas as verificações
    $cliente = new Cliente();
    //passa os dados para o objeto
    $cliente->setNome($nome);
    $cliente->setNascimento($nascimento);
    $cliente->setIdCliente($idCliente);
    //chama o método cadastrar
    $resultado = $cliente->cadastrar();

    if ($resultado == true) {
        header('HTTP/1.1 201 Created');
        $resposta['cod'] = "ok";
        $resposta['msg'] = "cadastrado com sucesso";
        $resposta['professor'] = $cliente;
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