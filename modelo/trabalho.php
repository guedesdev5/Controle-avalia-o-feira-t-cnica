<?php
include "Banco.php";
class Cliente implements JsonSerializable
{
    private $idTrabalho;
    private $nome;
    private $idcurso;
    private $resumo;

    private $banco;
    public function jsonSerialize()
    {
        $json = array();
        $json['nome'] = $this->getNome();
        $json['resumo'] = $this->getresumo();
        $json['codigo trabalho'] = $this->getidcurso();
        $json['id curso'] = $this->getidTrabalho();

        return $json;
    }

    public function cadastrar()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("insert into trabalho (nomeTrabalho, resumo, Curso_idCurso)values(?, ?, ?)");
        $stmt->bind_param("ssi", $this->nome, $this->resumo, $this->idcurso);
        $resposta = $stmt->execute();
        $idCadastrado = $this->banco->getConexao()->insert_id;
        $this->setIdcurso($idCadastrado);
        return $resposta;
    }

    public function excluir()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("delete from trabalho where idTrabalho = ?");
        $stmt->bind_param("i", $this->idcurso);
        return $stmt->execute();
    }

    public function buscar($idcurso)
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("select * from trabalho where idTrabalho = ?");
        $stmt->bind_param("i", $idcurso);
        $stmt->execute();
        $resultado = $stmt->get_result();
        while ($linha = $resultado->fetch_object()) {
            $this->setIdcurso($linha->idTrabalho);
            $this->setNome($linha->nomeTrabalho);
            $this->setresumo($linha->resumo);
           
      
        }
        return $this;
    }

    public function listar()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("Select * from trabalho");
        $stmt->execute();
        $result = $stmt->get_result();
        $vetorClientes = array();
        $i = 0;
        while ($linha = mysqli_fetch_object($result)) {
            $vetorClientes[$i] = new Cliente();
            $vetorClientes[$i]->setidcurso($linha->idTrabalho);
            $vetorClientes[$i]->setNome(($linha->nomeTrabalho));
            $vetorClientes[$i]->setresumo(($linha->resumo));
            $vetorClientes[$i]->setidtrabalho(($linha->Curso_idCurso));
            
            
            
            
            $i++;
        }
        return $vetorClientes;
    }

    public function listarALFA()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("SELECT * FROM trabalho ORDER BY nomeTrabalho ASC, Curso_idCurso DESC;");
        $stmt->execute();
        $result = $stmt->get_result();
        $vetorClientes = array();
        $i = 0;
        while ($linha = mysqli_fetch_object($result)) {
            $vetorClientes[$i] = new Cliente();
            $vetorClientes[$i]->setidcurso($linha->idTrabalho);
            $vetorClientes[$i]->setNome(($linha->nomeTrabalho));
            $vetorClientes[$i]->setresumo(($linha->resumo));
            $vetorClientes[$i]->setidtrabalho(($linha->Curso_idCurso));
            
            
            
            
            $i++;
        }
        return $vetorClientes;
    }

    public function listarNOTAeCURSO()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("SELECT Trabalho_idTrabalho from avaliacao ORDER BY notaGeral DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $vetorClientes = array();
        $i = 0;
        while ($linha = mysqli_fetch_object($result)) {
            $vetorClientes[$i] = new Cliente();
            $vetorClientes[$i]->setidtrabalho(($linha->Trabalho_idTrabalho));
            
            
            
            
            $i++;
        }
        return $vetorClientes;
    }

    

    public function listarAnonimos()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("select Trabalho_idTrabalho from avaliacao Where professor_registro is NULL Having max(notaGeral)");
        $stmt->execute();
        $result = $stmt->get_result();
        $vetorClientes = array();
        $i = 0;
        while ($linha = mysqli_fetch_object($result)) {
            $vetorClientes[$i] = new Cliente();
            $vetorClientes[$i]->setIdcurso($linha->Trabalho_idTrabalho);
            $i++;
        }
        return $vetorClientes;
    }
    public function getIdTrabalho()
    {
        return $this->idTrabalho;
    }
    public function setIdTrabalho($v)
    {
        $this->idTrabalho = $v;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getresumo()
    {
        return $this->resumo;
    }
    public function setresumo($resumo)
    {
        $this->resumo = $resumo;
    }

    public function getidcurso()
    {
        return $this->idcurso;
    }
    public function setidcurso($idcurso)
    {
        $this->idcurso = $idcurso;
    }
    
    
    
   
   
}
