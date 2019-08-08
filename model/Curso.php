<?php

class Curso{
    private $idCurso;
    private $nome;
    private $turno;
	private $carga_horaria;
	private $data;

    function __construct($nome, $turno, $carga_horaria, $data){
        $this->nome = $nome;
        $this->turno = $turno;
		$this->carga_horaria = $carga_horaria;
		$this->data = $data;
    }
    public function setIdCurso($idCurso)
	{
		$this->idCurso = $idCurso;
	}

	public function getIdCurso()
	{
		return $this->idCurso;
	}
	public function setTurno($turno)
	{
		$this->turno = $turno;
	}

	public function getTurno()
	{
		return $this->turno;
	}

    public function setNome($nome)
	{
		$this->nome = $nome;
	}

	public function getNome()
	{
		return $this->nome;
    }

    public function setCarga_horaria($carga_horaria)
	{
		$this->carga_horaria = $carga_horaria;
	}

	public function getCarga_horaria()
	{
		return $this->carga_horaria;
	}
	
	public function setData($data)
	{
		$this->data = $data;
	}

	public function getData()
	{
		return $this->data;
    }   



}

?>