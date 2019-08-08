<?php

class Aluno
{	
	private $idAluno;
	private $nome;
	private $matricula;
	private $email;
	private $telefone;
	private $ano_inicial;
	private $periodo;
	private $graduacao;

	function __construct($nome, $matricula, $email, $telefone, $ano_inicial, $periodo, $graduacao)
	{
		$this->matricula = $matricula;
		$this->nome = $nome;
		$this->telefone = $telefone;
		$this->email = $email;
		$this->ano_inicial = $ano_inicial;
		$this->periodo = $periodo;
		$this->graduacao = $graduacao;

	}

	public function setIdAluno($idAluno)
	{
		$this->idAluno = $idAluno;
	}

	public function getIdAluno()
	{
		return $this->idAluno;
	}

	public function setMatricula($matricula)
	{
		$this->matricula = $matricula;
	}

	public function getMatricula()
	{
		return $this->matricula;
	}

	public function setNome($nome)
	{
		$this->nome = $nome;
	}

	public function getNome()
	{
		return $this->nome;
	}

	public function setTelefone($telefone)
	{
		$this->telefone = $telefone;
	}

	public function getTelefone()
	{
		return $this->telefone;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setAno_inicial($ano_inicial)
	{
		$this->ano_inicial = $ano_inicial;
	}

	public function getAno_inicial()
	{
		return $this->ano_inicial;
	}

	public function setPeriodo($periodo)
	{
		$this->periodo = $periodo;
	}

	public function getPeriodo()
	{
		return $this->periodo;
	}

	public function setGraduacao($graduacao)
	{
		$this->graduacao = $graduacao;
	}

	public function getGraduacao()
	{
		return $this->graduacao;
	}
	
}

?>