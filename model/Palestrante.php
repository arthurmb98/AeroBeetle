<?php

class Palestrante
{	
	private $idPalestrante;
	private $nome;
	private $cpf;
	private $email;
	private $telefone;

	function __construct($nome, $cpf, $email, $telefone)
	{
		$this->cpf = $cpf;
		$this->nome = $nome;
		$this->telefone = $telefone;
		$this->email = $email;
	}

	public function setIdPalestrante($idPalestrante)
	{
		$this->idPalestrante = $idPalestrante;
	}

	public function getIdPalestrante()
	{
		return $this->idPalestrante;
	}

	public function setCpf($cpf)
	{
		$this->cpf = $cpf;
	}

	public function getCpf()
	{
		return $this->cpf;
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

}

?>