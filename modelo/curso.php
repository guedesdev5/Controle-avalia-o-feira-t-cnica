<?php
include "Banco.php";
class Cliente implements JsonSerializable
{
    private $idcurso;
    private $nome;
    private $banco;
    public function jsonSerialize()
    {
        $json = array();
        $json['idcurso'] = $this->getIdcurso();
        $json['nome'] = $this->getNome();
        return $json;
    }

    public function cadastrar()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("insert into curso (nomeCurso)values(?)");
        $stmt->bind_param("s", $this->nome);
        $resposta = $stmt->execute();
        $idCadastrado = $this->banco->getConexao()->insert_id;
        $this->setIdcurso($idCadastrado);
        return $resposta;
    }

    public function excluir()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("delete from curso where idCurso = ?");
        $stmt->bind_param("i", $this->idcurso);
        return $stmt->execute();
    }

   
    public function buscar($idcurso)
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("select * from curso where idCurso = ?");
        $stmt->bind_param("i", $idcurso);
        $stmt->execute();
        $resultado = $stmt->get_result();
        while ($linha = $resultado->fetch_object()) {
            $this->setIdcurso($linha->idCurso);
            $this->setNome($linha->nomeCurso);
           
      
        }
        return $this;
    }

    public function listar()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("Select * from curso");
        $stmt->execute();
        $result = $stmt->get_result();
        $vetorClientes = array();
        $i = 0;
        while ($linha = mysqli_fetch_object($result)) {
            $vetorClientes[$i] = new Cliente();
            $vetorClientes[$i]->setIdcurso($linha->idCurso);
            $vetorClientes[$i]->setNome(($linha->nomeCurso));
            
            
            $i++;
        }
        return $vetorClientes;
    }
    public function getIdcurso()
    {
        return $this->idcurso;
    }
    public function setIdcurso($v)
    {
        $this->idcurso = $v;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    
    
   
   
}
