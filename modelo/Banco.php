<?php
class Banco
{
    private $host = "localhost";
    private $usuario = "root";
    private $senha = "pietro29012007";
    private $banco = "feitaTecnica";
    private $porta = "3306";
    private $con = null;
    private function conectar()
    {
        $this->con = new mysqli($this->host, $this->usuario, $this->senha, $this->banco, $this->porta);
        if ($this->con->connect_error) {
            die("Falha ao conectar: " . $this->con->connect_error);
        }
    }
    public function getConexao()
    {
        if ($this->con == null) {
            $this->conectar();
        }
        return $this->con;
    }
}
