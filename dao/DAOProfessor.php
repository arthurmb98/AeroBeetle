<?php

//include"seguranca.php";

require_once '../model/Professor.php';
require_once '../seguranca/Conexao.php';
require_once '../seguranca/Log.php';
/**
* 
*/
define('LOCAL_DP', 'DAOProfessor.php');

class DAOProfessor
{

	private static $instance;

	function __construct()
	{
		//empty
	}
	public function getInstance()
	{
		if (!isset(self::$instance)) {
			self::$instance = new DAOProfessor();
		}

		return self::$instance;
	}

	public function insert(Professor $professor){
		try{
			$sql = "INSERT INTO professor(nome) VALUES (?)";
			$stmt = Conexao::getInstance()->prepare($sql);
			$stmt->bindParam(1, $professor->getNome());
			$stmt->execute();
			Log::getInstance()->inserir(LOCAL_DP,"INSERT na tabela professor executada...");
			return true;
		}
		catch(Exception $e){
			Log::getInstance()->inserir(LOCAL_DP,(" - Erro - ".$e->getCode()." - ".$e->getMessage()));
			return false;
		}
	}

	public function update(Professor $professor){
		try{
			$sql = "UPDATE professor SET nome = ?";

			$stmt = Conexao::getInstance()->prepare($sql);
			$stmt->bindParam(1, $professor->getNome());
			$stmt->execute();
			Log::getInstance()->inserir(LOCAL_DP,"UPDATE na tabela professor executada...");
		}catch(Exception $e){
			Log::getInstance()->inserir(LOCAL_DP,(" - Erro - ".$e->getidCode()." - ".$e->getMessage()));
		}
	}

	public function select($idProfessor){
		try{
			$sql = "SELECT * FROM `professor` WHERE `idProfessor` = ?";
			$stmt = Conexao::getInstance()->prepare($sql);
			$stmt->bindParam(1, $idProfessor);
			$stmt->execute();
			Log::getInstance()->inserir(LOCAL_DP,"SELECT na tabela professor executada...");
			return $this->toProfessor($stmt->fetch(PDO::FETCH_ASSOC));			
		}
		catch(Exception $e){
			Log::getInstance()->inserir(LOCAL_DP,(" - Erro - ".$e->getCode()." - ".$e->getMessage()));
		}

	}

	public function toProfessor($row){
		$professor = new Professor($row['idProfessor'],$row['nome']);
		return $professor;
	}

	public function selectAll()
	{
		try {
            $sql = "SELECT * FROM professor ORDER BY nome";
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->execute();
            Log::getInstance()->inserir(LOCAL_DP,"SELECT na tabela `professor` executada...");
			$actions = "actions";
			$btn_success = "btn btn-success btn-xs";
			$btn_warning = "btn btn-warning btn-xs";
			$btn_danger = "btn btn-danger btn-xs";
			$modal = "modal";
			$delete_modal = "#delete-modal";

			$pos = 1;
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
				$idProfessor = $result['idProfessor'];
				$nomeProfessor = $result['nome'];
				$hrefView = "view.php?idProfessor=$idProfessor";
				$hrefEdit = "edit.php?idProfessor=$idProfessor";
				$hrefAluno = "../acoes/alunoProfessor.php?idButton=$idProfessor";
				$hrefDelete = "#";
				echo "<tr>
				<td>$idProfessor</td>
				<td>$nomeProfessor</td>
				<td class=$actions>
					<a class=$btn_success href=$hrefView>Visualizar</a>
					<a class=$btn_success href=$hrefAluno>Alunos</a>
					<a class=$btn_warning href=$hrefEdit>Editar</a>
					<a class=$btn_danger  href=$hrefDelete data-toggle=$modal data-target=$delete_modal>Excluir</a>
				</td>
			</tr>";
				$pos++;
            }

        } catch (Exception $e) {
            Log::getInstance()->inserir(LOCAL_DA,"Erro - " . $e->getCode() . " - " . $e->getMessage());
        }
	}


	public function delete($idProfessor)
	{
		try {
			$sql = "DELETE * FROM `professor` WHERE `idProfessor`= ?";
			$stmt = Conexao::getInstance()->prepare($sql);
			$stmt->bindParam(1, $idProfessor); 
			$stmt->execute();
			Log::getInstance()->inserir(LOCAL_DP,"DELETE na tabela professor executada...");			
		} catch (Exception $e) {
			Log::getInstance()->inserir(LOCAL_DP,(" - Erro - ".$e->getCode()." - ".$e->getMessage()));
		}
	}

}