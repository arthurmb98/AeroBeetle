<?php

//include "seguranca.php";

require_once '../seguranca/Conexao.php';
require_once '../seguranca/Log.php';
require_once '../model/Aluno.php';

/**
* 
*/
define('LOCAL_DA', 'DAOAluno.php');

class DAOAluno
{
	private static $instance;

	function __construct()
	{
	}

	public function getInstance()
	{
		if (!isset(self::$instance)) {
			self::$instance = new DAOAluno();
		}

		return self::$instance;
	}

	public function insert(Aluno $aluno)
	{
		try {
			$sql = "INSERT INTO aluno(nome, matricula, email, telefone, periodo, idGraduacao)
			values(?, ?, ?, ?, ?, ?)";

			$stmt = Conexao::getInstance()->prepare($sql);
			$stmt->bindParam(1, $aluno->getNome()); 
			$stmt->bindParam(2, $aluno->getMatricula()); 
			$stmt->bindParam(3, $aluno->getEmail()); 
			$stmt->bindParam(4, $aluno->getTelefone()); 
			$stmt->bindParam(5, $aluno->getPeriodo()); 
			$stmt->bindParam(6, $aluno->getGraduacao()); 
			$stmt->execute();
			Log::getInstance()->inserir(LOCAL_DA,"INSERT na tabela Aluno executada...");
			return true;
		} catch (Exception $e) {
			Log::getInstance()->inserir(LOCAL_DA,(" - Erro - ".$e->getCode()." - ".$e->getMessage()));
			return false;
		}
	}

	public function update(Aluno $aluno)
	{
		try {
			$sql = "UPDATE aluno SET
			nome = ?, matricula = ?, email = ?, telefone = ?, ano_inicial = ?, periodo = ?, idGraduacao = ?
			WHERE idAluno = ?";
			$stmt = Conexao::getInstance()->prepare($sql);
			$stmt->bindParam(1, $aluno->getNome());
			$stmt->bindParam(2, $aluno->getMatricula());  
			$stmt->bindParam(3, $aluno->getEmail());
			$stmt->bindParam(4, $aluno->getTelefone()); 
			$stmt->bindParam(5, $aluno->getAno_inicial()); 
			$stmt->bindParam(6, $aluno->getPeriodo()); 
			$stmt->bindParam(7, $aluno->getGraduacao()); 
			$stmt->bindParam(8, $aluno->getIdAluno()); 
			$stmt->execute();
			Log::getInstance()->inserir(LOCAL_DA,"UPDATE na tabela Aluno executada...");			
		} catch (Exception $e) {
			Log::getInstance()->inserir(LOCAL_DA,(" - Erro - ".$e->getCode()." - ".$e->getMessage()));
		}

	}

	public function delete($idAluno)
	{
		try {
			$sql = "DELETE FROM aluno WHERE idAluno=?";
			$stmt = Conexao::getInstance()->prepare($sql);
			$stmt->bindValue(1, $idAluno); 
			$stmt->execute();
			Log::getInstance()->inserir(LOCAL_DA,"DELETE na tabela Aluno executada...");
			return true;			
		} catch (Exception $e) {
			Log::getInstance()->inserir(LOCAL_DA,(" - Erro - ".$e->getCode()." - ".$e->getMessage()));
			return false;
		}
	}

	public function select($idAluno)
	{
		try {
            $sql = "SELECT * FROM aluno WHERE idAluno = ?";
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindParam(1, $idAluno);
            $stmt->execute();
            Log::getInstance()->inserir(LOCAL_DA,"SELECT na tabela `aluno` executada...");
            return $this->toAluno($stmt->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            Log::getInstance()->inserir(LOCAL_DA,"Erro - " . $e->getCode() . " - " . $e->getMessage());
        }
	}

	private function toAluno($row)
	{
		$aluno = new Aluno($row['nome'], $row['matricula'], $row['email'], $row['telefone'],$row['ano_inicial'],
		$row['periodo'],$row['idGraduacao']);
		$aluno->setIdAluno($row['idAluno']);

        return $aluno;
	}

	public function selectAll()
	{
		try {
            $sql = "SELECT * FROM aluno";
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->execute();
            Log::getInstance()->inserir(LOCAL_DA,"SELECT na tabela `aluno` executada...");
			$actions = "actions";
			$btn_success = "btn btn-success btn-xs";
			$btn_warning = "btn btn-warning btn-xs";
			$btn_danger = "btn btn-danger btn-xs";
			$modal = "modal";
			$delete_modal = "#delete-modal";

			$pos = 1;
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
				$idAluno = $result['idAluno'];
				$nomeAluno = $result['nome'];
				$email = $result['email'];
				$periodo = $result['periodo'];

				$hrefView = "view.php?idAluno=$idAluno";
				$hrefMatricular = "../acoes/matricular.php?idButton=$idAluno";
				$hrefProfessor = "../acoes/professorAluno.php?idButton=$idAluno";
                $hrefEdit = "edit.php?idAluno=$idAluno";
				$hrefDelete = "";
				echo "<tr>
				<td>$idAluno</td>
				<td>$nomeAluno</td>
				<td>$email</td>
				<td>$periodo</td>
				<td class=$actions>
					<a class=$btn_success href=$hrefView>Visualizar</a>
					<a class=$btn_warning href=$hrefProfessor>Vincular a Professor</a>
					<a class=$btn_success href=$hrefMatricular>Matricular</a>
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

	public function selectbycurso($idCurso)
	{
		try {
            $sql = "select * from aluno where idAluno in ( select idAluno from alunocurso WHERE idCurso=?) ORDER BY nome";
			$stmt = Conexao::getInstance()->prepare($sql);
			$stmt->bindParam(1, $idCurso);
            $stmt->execute();
            Log::getInstance()->inserir(LOCAL_DA,"SELECT na tabela `aluno` executada...");
			$scope = "row";
        	$type = "button";
            $class = "btn btn-primary";
            $cadastro = "Editar";
            $inscricao = "Editar";
			$deletar = "Deletar";
			$certificado = "Gerar Certificado";
			$pos = 1;
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            	//printf("<br>".$pos."° %s (%s) - Nota Hersberg: %g <br>", $result['nome'], $result['matricula'], $result['nota_hersberg']);
				$nomeAluno = $result['nome'];
				$email = $result['email'];
				$periodo = $result['periodo'];
				$nameEditCad = $nomeAluno;
				$idEditCad = $result['idAluno'];
				$nameEditInsc = $nomeAluno;
				$idEditInsc = $result['idAluno'];
				$nameDelete = $nomeAluno;
				$idDelete = $result['idAluno'];
				$hrefEditCad = "../acoes/editCadastro.php?idButton=$idEditCad";
                $hrefEditInsc = "../acoes/editInscricao.php?idButton=$idEditInsc";
				$hrefDelete = "../acoes/deleteAluno.php?idButton=$idDelete";
				$hrefCertificado = "../gerar_certificado/gerador.php?idAluno=$idDelete&idCurso=$idCurso";
				echo "<tr>
				  <th scope= $scope>$idEditCad</th>
				  <td>$nomeAluno</td>
				  <td>$email</td>
				  <td>$periodo</td>
				  <td> <a href= $hrefCertificado> <button type= $type class=$class name=$nameDelete id=$idDelete>$certificado</button></a></td>
				  <td> <a href= $hrefDelete> <button type= $type class=$class name=$nameDelete id=$idDelete>$deletar</button></a></td>
				  </tr>";	
				$pos++;
            }

        } catch (Exception $e) {
            Log::getInstance()->inserir(LOCAL_DA,"Erro - " . $e->getCode() . " - " . $e->getMessage());
        }
	}

	function matricular($idAluno){
		try {
            $sql = "SELECT palestrantecurso.sala as Sala,
			curso.idCurso as idCurso, 
			curso.nome as Curso, 
			palestrante.nome as Palestrante, 
			curso.carga_horaria as CH, 
			curso.idTurno as Turno, 
			curso.data as Data
			FROM palestrantecurso,curso, palestrante 
			where palestrantecurso.idPalestrante = palestrante.idPalestrante
			and palestrantecurso.idCurso = curso.idCurso";
			//
            $stmt = Conexao::getInstance()->prepare($sql);
			$stmt->execute();
			$scope = "row";
        	$type = "button";
            $class = "btn btn-primary";
            $editar= "Inscrever-se";
			$pos = 1;
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
				$nomeCurso = $result['Curso'];
				$ch = $result['CH'];
				if($result['Turno'] ==1){
						$turno = "MATUTINO";
				}else if($result['Turno'] ==2){
						$turno = "VESPERTINO";
				}else{$turno = "NOTURNO";}
				$data = date('d-m-Y', strtotime($result['Data']));
				$professor = $result['Palestrante'];
				$sala = $result['Sala'];
				$nameEditar = $nomeCurso;
				$idEditar = $result['idCurso'];
				$hrefEditar = "../acoes/matricular.php?idCurso=$idEditar&idAluno=$idAluno&Sala=$sala";
				//if($idAluno == $result['idAluno']){
				echo "<tr>
				  <th scope= $scope>$pos</th>
				  <td>$nomeCurso</td>
				  <td>$ch</td>
				  <td>$turno</td>
				  <td>$professor</td>
				  <td>$sala</td>
				  <td>$data</td>
				  <td> <a href= $hrefEditar><button type= $type class=$class name=$nameEditar id=$idEditar>$editar</button></a></td>
				  </tr>";	
				$pos++;
			//}
			}

            return true;
        } catch (Exception $e) {
			Log::getInstance()->inserir(LOCAL_DA,"Erro - " . $e->getCode() . " - " . $e->getMessage());
			return false;
        }

	}

	function alunoprofessor($idAluno){
		try {
            $sql = "SELECT * FROM professor";
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->execute();
            Log::getInstance()->inserir(LOCAL_DA,"SELECT na tabela `professor` executada...");
			$actions = "actions";
			$btn_success = "btn btn-success btn-xs";
			$btn_warning = "btn btn-warning btn-xs";
			$btn_danger = "btn btn-danger btn-xs";
			$modal = "modal";
			$delete_modal = "#delete-modal";

			$pos = 1;
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
				$idProfessor = $result['idProfessor'];
				$nome = $result['nome'];
				$href = "../acoes/professorAluno.php?idProfessor=$idProfessor&idAluno=$idAluno";
				echo "<tr>
				<td>$idProfessor</td>
				<td>$nome</td>
				<td class=$actions>
					<a class=$btn_success href=$href>Vincular</a>
				</td>
			</tr>";
				$pos++;
            }


            return true;
        } catch (Exception $e) {
			Log::getInstance()->inserir(LOCAL_DA,"Erro - " . $e->getCode() . " - " . $e->getMessage());
			return false;
        }

	}

}

//$da = DAOCargoDA::GetInstance()->select("Presidente");
//$curso = DAOCurso::GetInstance()->select(10);
//$aluno = new Aluno(1509132 ,"Arthur Moura", 982103337, "arthur@email.com", 2015, 7.1, 0, 0, null, null, 0, 0,2400, 5, $curso);
//DAOAluno::getInstance()->insert($aluno);

//$aluno = DAOAluno::getInstance()->select(1509132);
//$aluno->setNome("Arthur");
//$aluno->setTelefone(982541354);
//$aluno->setIra(6.95);
//DAOAluno::getInstance()->update($aluno);

//Log::getInstance()->mostrar();


//DAOAluno::getInstance()->selectAll();

//

//




//




?>
