<?php

class Professor{
    private $idProfessor;
    private $nome;

    function __construct($nome){
        $this->nome = $nome;
    }

    public function setIdProfessor($idProfessor)
	{
		$this->idProfessor = $idProfessor;
    }
    public function getIdProfessor()
	{
		return $this->idProfessor;
    }
    public function setNome($nome)
	{
		$this->nome = $nome;
    }
    public function getNome()
	{
		return $this->nome;
	}

}

?>