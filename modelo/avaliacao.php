<?php
include "Banco.php";
class Cliente implements JsonSerializable
{
    private $idprof;
    private $nota;
    private $obs;
    private $idtrabalho;
    private $ida;
    private $anonimo;
    private $result = 0;
    private $banco;
    public function jsonSerialize()
    {
        $json = array();
        $json['idProfessor'] = $this->getIdprof();
        $json['nota'] = $this->getnota();
        $json['observacao'] = $this->getobs();
        $json['idTrabalho'] = $this->getidtrabalho();
        return $json;
    }

    public function cadastrar()
    {
        $this->banco = new Banco();
        $teste = $this->banco->getConexao()->prepare("select * from avaliacao where professor_registro = ?");
        $teste->bind_param("i", $this->idprof);
        $teste->execute();
        $teste->store_result();
        $rows = $teste->num_rows;
        if($rows==0){
            $stmt = $this->banco->getConexao()->prepare("insert into avaliacao (professor_registro, notaGeral, obs, Trabalho_idTrabalho)values(?, ?, ?, ?)");
        $stmt->bind_param("idsi", $this->idprof, $this->nota, $this->obs, $this->idtrabalho);
        $resposta = $stmt->execute();
        $idCadastrado = $this->banco->getConexao()->insert_id;
        $this->setIdava($idCadastrado);
        return $resposta;
        }else{
            $resposta = false;
            return $resposta;
        }      
    }

   

    public function cadastrarAnonimo()
    {
        $this->banco = new Banco();
       
        $stmt = $this->banco->getConexao()->prepare("insert into avaliacao (professor_registro, notaGeral, obs, Trabalho_idTrabalho)values(?, ?, ?, ?)");
        $stmt->bind_param("idsi", $this->idprof, $this->nota, $this->obs, $this->idtrabalho);
        $resposta = $stmt->execute();
        $idCadastrado = $this->banco->getConexao()->insert_id;
        $this->setIdava($idCadastrado);
        return $resposta;
            
    }
  

    public function listar()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("select * from avaliacao Where professor_registro is NOT NULL Order By Trabalho_idTrabalho limit 10 ");
        $stmt->execute();
        $result = $stmt->get_result();
        $vetorClientes = array();
        $i = 0;
        while ($linha = mysqli_fetch_object($result)) {
            $vetorClientes[$i] = new Cliente();
            $vetorClientes[$i]->setIdprof($linha->professor_registro);
            $vetorClientes[$i]->setnota(($linha->notaGeral));        
            $vetorClientes[$i]->setobs(($linha->obs));     
            $vetorClientes[$i]->setidtrabalho(($linha->Trabalho_idTrabalho));    
            $i++;
        }
        return $vetorClientes;
    }

    public function listarTDS()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("select * from avaliacao  ");
        $stmt->execute();
        $result = $stmt->get_result();
        $vetorClientes = array();
        $i = 0;
        while ($linha = mysqli_fetch_object($result)) {
            $vetorClientes[$i] = new Cliente();
            $vetorClientes[$i]->setIdprof($linha->professor_registro);
            $vetorClientes[$i]->setnota(($linha->notaGeral));        
            $vetorClientes[$i]->setobs(($linha->obs));     
            $vetorClientes[$i]->setidtrabalho(($linha->Trabalho_idTrabalho));    
            $i++;
        }
        return $vetorClientes;
    }
    public function getIdprof()
    {
        return $this->idprof;
    }
    public function setIdprof($v)
    {
        $this->idprof = $v;
    }
    public function getnota()
    {
        return $this->nota;
    }
    public function setnota($nota)
    {
        $this->nota = $nota;
    }
    public function getobs()
    {
        return $this->obs;
    }
    public function setobs($obs)
    {
        $this->obs = $obs;
    }
    public function getidtrabalho()
    {
        return $this->idtrabalho;
    }
    public function setidtrabalho($idtrabalho)
    {
        $this->idtrabalho = $idtrabalho;
    }
    public function setidava($ida)
    {
        $this->ida = $ida;
    }

    public function getanonimo()
    {
        return $this->anonimo;
    }

    public function setanonimo($anonimo)
    {
        $this->anonimo = $anonimo;
    }
    
    
   
   
}
