<?php
include "Banco.php";
class classe implements JsonSerializable
{
    private $idTrabalho;
    private $nome;
    private $idcurso;
    private $resumo;

    private $banco;
    public function jsonSerialize()
    {
        
        $json = array();

        $json['codigo trabalho'] = $this->getidcurso();
        $json['codigo curso'] = $this->getIdTrabalho();

   

        return $json;
    }

    public function listarAnonimos()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("select avaliacao.Trabalho_idTrabalho, trabalho.Curso_idCurso from avaliacao INNER JOIN trabalho  on avaliacao.Trabalho_idTrabalho = trabalho.idtrabalho  Where avaliacao.professor_registro is NULL Having max(notaGeral);");
        $stmt->execute();
        $result = $stmt->get_result();
        $vetorClientes = array();
        $i = 0;
        while ($linha = mysqli_fetch_object($result)) {
            $vetorClientes[$i] = new classe();
            $vetorClientes[$i]->setIdcurso($linha->Trabalho_idTrabalho);
            $vetorClientes[$i]->setIdTrabalho($linha->Curso_idCurso);
            $i++;
        }
        return $vetorClientes;
    }
    public function listarOrdenados()
    {
        $this->banco = new Banco();
        $stmt = $this->banco->getConexao()->prepare("select Trabalho_idTrabalho, Curso_idCurso from trabalho INNER join avaliacao on trabalho.idTrabalho  = avaliacao.Trabalho_idTrabalho where notaGeral >= 9 and avaliacao.professor_registro is NULL; ");
        $stmt->execute();
        $result = $stmt->get_result();
        $vetorClientes = array();
        $i = 0;
        while ($linha = mysqli_fetch_object($result)) {
            $vetorClientes[$i] = new classe();
            $vetorClientes[$i]->setIdcurso($linha->Trabalho_idTrabalho);
            $vetorClientes[$i]->setIdTrabalho($linha->Curso_idCurso);
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
