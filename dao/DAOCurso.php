<?php

//include"seguranca.php";

require_once '../model/Curso.php';
require_once '../seguranca/Conexao.php';
require_once '../seguranca/Log.php';
/**
* 
*/
define('LOCAL_DC', 'DAOCurso.php');

class DAOCurso
{

	private static $instance;

	function __construct()
	{
		//empty
	}
	public function getInstance()
	{
		if (!isset(self::$instance)) {
			self::$instance = new DAOCurso();
		}

		return self::$instance;
	}

	public function insert(Curso $curso){
		try{
			$sql = "INSERT INTO curso(nome,  idTurno, carga_horaria, data) 
			VALUES (?,?,?,?)";
			$stmt = Conexao::getInstance()->prepare($sql);
			$stmt->bindParam(1, $curso->getNome());
			$stmt->bindParam(2, $curso->getTurno());
			$stmt->bindParam(3, $curso->getCarga_horaria());
			$stmt->bindParam(4, $curso->getData());
			$stmt->execute();
			Log::getInstance()->inserir(LOCAL_DC,"INSERT na tabela curso executada...");
			return true;
		}
		catch(Exception $e){
			Log::getInstance()->inserir(LOCAL_DC,(" - Erro - ".$e->getCode()." - ".$e->getMessage()));
			return false;
		}
	}

	public function update(Curso $curso){
		try{
			$sql = "UPDATE curso SET nome = ?, carga_horaria = ?, idTurno = ?, data = ? WHERE idCurso = ?";

			$stmt = Conexao::getInstance()->prepare($sql);
			$stmt->bindParam(1, $curso->getNome());
			$stmt->bindParam(2, $curso->getCarga_horaria());
			$stmt->bindParam(3, $curso->getTurno());
			$stmt->bindParam(4, $curso->getData());
			$stmt->bindParam(5, $curso->getidCurso());
			$stmt->execute();
			Log::getInstance()->inserir(LOCAL_DC,"UPDATE na tabela curso executada...");
		}catch(Exception $e){
			Log::getInstance()->inserir(LOCAL_DC,(" - Erro - ".$e->getidCode()." - ".$e->getMessage()));
		}
	}

	public function select($idCurso){
		try{
			$sql = "SELECT * FROM `curso` WHERE `idCurso` = ?";
			$stmt = Conexao::getInstance()->prepare($sql);
			$stmt->bindParam(1, $idCurso);
			$stmt->execute();
			Log::getInstance()->inserir(LOCAL_DC,"SELECT na tabela curso executada...");
			return $this->toCurso($stmt->fetch(PDO::FETCH_ASSOC));			
		}
		catch(Exception $e){
			Log::getInstance()->inserir(LOCAL_DC,(" - Erro - ".$e->getCode()." - ".$e->getMessage()));
		}

	}

	public function toCurso($row){
		$curso = new Curso($row['idCurso'],$row['nome'],$row['carga_horaria'],$row['idTurno'], $row['data']);
		return $curso;
	}

	public function delete($idCurso)
	{
		try {
			$sql = "DELETE FROM `curso` WHERE `idCurso`= ?";
			$stmt = Conexao::getInstance()->prepare($sql);
			$stmt->bindParam(1, $idCurso); 
			$stmt->execute();
			Log::getInstance()->inserir(LOCAL_DC,"DELETE na tabela curso executada...");			
		} catch (Exception $e) {
			Log::getInstance()->inserir(LOCAL_DC,(" - Erro - ".$e->getCode()." - ".$e->getMessage()));
		}
	}
	public function selectAll()
	{
		try {
            $sql = "SELECT * FROM curso ORDER BY nome";
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->execute();
            Log::getInstance()->inserir(LOCAL_DC,"SELECT na tabela `aluno` executada...");
			$actions = "actions";
			$btn_success = "btn btn-success btn-xs";
			$btn_warning = "btn btn-warning btn-xs";
			$btn_danger = "btn btn-danger btn-xs";
			$modal = "modal";
			$delete_modal = "#delete-modal";
			$pos = 1;
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
				$idCurso = $result['idCurso'];
            	$nomeCurso = $result['nome'];
				$ch = $result['carga_horaria']." horas";
				if($result['idTurno'] ==1){
						$turno = "MATUTINO";
				}else if($result['idTurno'] ==2){
						$turno = "VESPERTINO";
				}else{$turno = "NOTURNO";}
				$data = date('d-m-Y', strtotime($result['data']));
				$hrefView = "view.php?idCurso=$idCurso";
				$hrefEdit = "edit.php?idCurso=$idCurso";
				$hrefPalestrantes = "../acoes/listaPalestrantePorCurso.php?idCurso=$idCurso";
				$hrefAlunos = "../acoes/listaAlunoPorCurso.php?idCurso=$idCurso";
				$hrefDelete = "";
				echo "<tr>
				<td>$idCurso</td>
				<td>$nomeCurso</td>
				<td>$ch</td>
				<td>$turno</td>
				<td>$data</td>
				<td class=$actions>
					<a class=$btn_success href=$hrefView>Visualizar</a>
					<a class=$btn_success href=$hrefPalestrantes>Palestrantes</a>
					<a class=$btn_success href=$hrefAlunos>Alunos</a>
					<a class=$btn_warning href=$hrefEdit>Editar</a>
					<a class=$btn_danger  href=$hrefDelete data-toggle=$modal data-target=$delete_modal>Excluir</a>
				</td>
			</tr>";
				$pos++;
            }

        } catch (Exception $e) {
            Log::getInstance()->inserir(LOCAL_DC,"Erro - " . $e->getCode() . " - " . $e->getMessage());
        }
	}

}

//$curso = new Curso("mat", 1, 60);
//DaoCurso::getInstance()->insert($curso);