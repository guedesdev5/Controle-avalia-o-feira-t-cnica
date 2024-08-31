<?php
include "Banco.php";
class Cliente implements JsonSerializable
{
    private $idCliente;
    private $id;
    private $nome;
    private $email;
    private $matricula;
    private $nascimento;
    private $salario;
    private $banco;
    public function jsonSerialize()
    {
        $json = array();
        $json['idTrabalho'] = $this->getIdTrabalho();
        $json['nomeAluno'] = $this->getNome();
        $json['turmaAluno'] = $this->getturma();
        $json['matricula'] = $this->getmatricula();
        return $json;
    }

    public function cadastrar()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("insert into alunosgrupo (Trabalho_idTrabalho ,matriculaAluno, nomeAluno, turmaAluno )values(?,?, ?, ?)");
        $stmt->bind_param("isss", $this->idCliente, $this->matricula, $this->nome, $this->nascimento);
        $resposta = $stmt->execute();
        return $resposta;
    }

    public function excluir()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("delete from alunosgrupo where matriculaAluno = ?");
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
        $stmt = $this->banco->getConexao()->prepare("select * from alunosgrupo where matriculaAluno = ?");
        $stmt->bind_param("i", $idCliente);
        $stmt->execute();
        $resultado = $stmt->get_result();
        while ($linha = $resultado->fetch_object()) {
            $this->setIdTrabalho($linha->Trabalho_idTrabalho);
            $this->setNome($linha->nomeAluno);
            $this->setturma($linha->turmaAluno);
            $this->setmatricula($linha->matriculaAluno);
      
        }
        return $this;
    }

    public function listar()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("Select * from alunosgrupo");
        $stmt->execute();
        $result = $stmt->get_result();
        $vetorClientes = array();
        $i = 0;
        while ($linha = mysqli_fetch_object($result)) {
            $vetorClientes[$i] = new Cliente();
            $vetorClientes[$i]->setIdTrabalho($linha->Trabalho_idTrabalho);
            $vetorClientes[$i]->setNome($linha->nomeAluno);
            $vetorClientes[$i]->setturma($linha->turmaAluno);
            $vetorClientes[$i]->setmatricula($linha->matriculaAluno);
            
            $i++;
        }
        return $vetorClientes;
    }
    public function getidtrabalho()
    {
        return $this->idCliente;
    }
    public function setidtrabalho($v)
    {
        $this->idCliente = $v;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setid($id)
    {
        $this->id = $id;
    }
    
    
    public function getturma()
    {
        return $this->nascimento;
    }
    public function setturma($v)
    {
        $this->nascimento = $v;
    }
    public function getmatricula()
    {
        return $this->matricula;
    }
    public function setmatricula($matricula)
    {
        $this->matricula = $matricula;
    }
   
}
