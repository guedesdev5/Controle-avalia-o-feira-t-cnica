<?php
include "Banco.php";
class Cliente implements JsonSerializable
{
    private $idCliente;
    private $nome;
    private $email;
    private $senha;
    private $nascimento;
    private $salario;
    private $banco;
    public function jsonSerialize()
    {
        $json = array();
        $json['registro'] = $this->getIdCliente();
        $json['nome'] = $this->getNome();
        $json['nascimento'] = $this->getNascimento();
        return $json;
    }

    public function cadastrar()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("insert into professor (registro, nome, nascimento )values(?,?, ?)");
        $stmt->bind_param("iss",$this->idCliente, $this->nome, $this->nascimento);
        $resposta = $stmt->execute();
        $idCadastrado = $this->banco->getConexao()->insert_id;
        $this->setIdCliente($idCadastrado);
        return $resposta;
    }

    public function excluir()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("delete from professor where registro = ?");
        $stmt->bind_param("i", $this->idCliente);
        return $stmt->execute();
    }

    public function atualizar()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("update professor set nome=?, nascimento=? where registro = ?");
        $stmt->bind_param("ssi", $this->nome, $this->nascimento, $this->idCliente);
        $stmt->execute();
    }
    public function buscar($idCliente)
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("select * from professor where registro = ?");
        $stmt->bind_param("i", $idCliente);
        $stmt->execute();
        $resultado = $stmt->get_result();
        while ($linha = $resultado->fetch_object()) {
            $this->setIdCliente($linha->registro);
            $this->setNome($linha->nome);
           
            $this->setNascimento($linha->nascimento);
      
        }
        return $this;
    }

    public function listar()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("Select * from professor");
        $stmt->execute();
        $result = $stmt->get_result();
        $vetorClientes = array();
        $i = 0;
        while ($linha = mysqli_fetch_object($result)) {
            $vetorClientes[$i] = new Cliente();
            $vetorClientes[$i]->setIdCliente($linha->registro);
            $vetorClientes[$i]->setNome(($linha->nome));
            $vetorClientes[$i]->setNascimento($linha->nascimento);
            
            $i++;
        }
        return $vetorClientes;
    }
    public function getIdCliente()
    {
        return $this->idCliente;
    }
    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    
    
    public function getNascimento()
    {
        return $this->nascimento;
    }
    public function setNascimento($v)
    {
        $this->nascimento = $v;
    }
   
}
