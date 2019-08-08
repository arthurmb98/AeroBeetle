<?php

//include "seguranca.php";

require_once '../seguranca/Conexao.php';
require_once '../seguranca/Log.php';
require_once '../model/Palestrante.php';

/**
* 
*/
define('LOCAL_DPA', 'DAOPalestrante.php');

class DAOPalestrante
{
	private static $instance;

	function __construct()
	{
	}

	public function getInstance()
	{
		if (!isset(self::$instance)) {
			self::$instance = new DAOPalestrante();
		}

		return self::$instance;
	}

	public function insert(Palestrante $Palestrante)
	{
		try {
			$sql = "INSERT INTO palestrante(nome, cpf, email, telefone)
			values(?, ?, ?, ?)";

			$stmt = Conexao::getInstance()->prepare($sql);
			$stmt->bindParam(1, $Palestrante->getNome()); 
			$stmt->bindParam(2, $Palestrante->getCpf()); 
			$stmt->bindParam(3, $Palestrante->getEmail()); 
			$stmt->bindParam(4, $Palestrante->getTelefone()); 
			$stmt->execute();
			Log::getInstance()->inserir(LOCAL_DPA,"INSERT na tabela palestrante executada...");
			return true;
		} catch (Exception $e) {
			Log::getInstance()->inserir(LOCAL_DPA,(" - Erro - ".$e->getCode()." - ".$e->getMessage()));
			return false;
		}
	}

	public function update(Palestrante $Palestrante)
	{
		try {
			$sql = "UPDATE palestrante SET
			nome = ?, cpf = ?, email = ?, telefone = ?
			WHERE idPalestrante = ?";
			$stmt = Conexao::getInstance()->prepare($sql);
			$stmt->bindParam(1, $Palestrante->getNome());
			$stmt->bindParam(2, $Palestrante->getCpf());  
			$stmt->bindParam(3, $Palestrante->getEmail());
			$stmt->bindParam(4, $Palestrante->getTelefone()); 
			$stmt->bindParam(5, $Palestrante->idPalestrante()); 
			$stmt->execute();
			Log::getInstance()->inserir(LOCAL_DA,"UPDATE na tabela palestrante executada...");			
		} catch (Exception $e) {
			Log::getInstance()->inserir(LOCAL_DA,(" - Erro - ".$e->getCode()." - ".$e->getMessage()));
		}

	}

	public function delete($idPalestrante)
	{
		try {
			$sql = "DELETE FROM Palestrante WHERE idPalestrante=?";
			$stmt = Conexao::getInstance()->prepare($sql);
			$stmt->bindValue(1, $idPalestrante); 
			$stmt->execute();
			Log::getInstance()->inserir(LOCAL_DA,"DELETE na tabela palestrante executada...");
			return true;			
		} catch (Exception $e) {
			Log::getInstance()->inserir(LOCAL_DA,(" - Erro - ".$e->getCode()." - ".$e->getMessage()));
			return false;
		}
	}

	public function select($idPalestrante)
	{
		try {
            $sql = "SELECT * FROM palestrante WHERE idPalestrante = ?";
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindParam(1, $idPalestrante);
            $stmt->execute();
            Log::getInstance()->inserir(LOCAL_DA,"SELECT na tabela `palestrante` executada...");
            return $this->toPalestrante($stmt->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            Log::getInstance()->inserir(LOCAL_DA,"Erro - " . $e->getCode() . " - " . $e->getMessage());
        }
	}

	private function toPalestrante($row)
	{
		$Palestrante = new Palestrante($row['nome'], $row['matricula'], $row['email'], $row['telefone'],$row['ano_inicial'],
		$row['periodo'],$row['idGraduacao']);
		$Palestrante->setIdPalestrante($row['idPalestrante']);

        return $Palestrante;
	}

	public function selectAll()
	{
		try {
            $sql = "SELECT * FROM palestrante";
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->execute();
            Log::getInstance()->inserir(LOCAL_DPA,"SELECT na tabela `palestrante` executada...");
			$actions = "actions";
			$btn_success = "btn btn-success btn-xs";
			$btn_warning = "btn btn-warning btn-xs";
			$btn_danger = "btn btn-danger btn-xs";
			$modal = "modal";
			$delete_modal = "#delete-modal";

			$pos = 1;
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
				$idPalestrante = $result['idPalestrante'];
				$nomePalestrante = $result['nome'];
				$email = $result['email'];

				$hrefView = "view.php?idPalestrante=$idPalestrante";
				$hrefCurso = "../acoes/palestranteCurso.php?idButton=$idPalestrante";
                $hrefEdit = "edit.php?idPalestrante=$idPalestrante";
				$hrefDelete = "";
				echo "<tr>
				<td>$idPalestrante</td>
				<td>$nomePalestrante</td>
				<td>$email</td>
				<td class=$actions>
					<a class=$btn_success href=$hrefView>Visualizar</a>
					<a class=$btn_success href=$hrefCurso>Ministrar Curso</a>
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
            $sql = "select * from palestrante where idPalestrante in ( select idPalestrante from palestrantecurso WHERE idCurso=?) ORDER BY nome";
			$stmt = Conexao::getInstance()->prepare($sql);
			$stmt->bindParam(1, $idCurso);
            $stmt->execute();
            Log::getInstance()->inserir(LOCAL_DPA,"SELECT na tabela `palestrante` executada...");
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
				$nomePalestrante = $result['nome'];
				$email = $result['email'];
				$nameEditCad = $nomePalestrante;
				$idEditCad = $result['idPalestrante'];
				$nameEditInsc = $nomePalestrante;
				$idEditInsc = $result['idPalestrante'];
				$nameDelete = $nomePalestrante;
				$idDelete = $result['idPalestrante'];
				$hrefDelete = "../acoes/deletePalestrante.php?idButton=$idDelete";
				$hrefCertificado = "../gerar_certificado/gerador.php?idPalestrante=$idDelete&idCurso=$idCurso";
				echo "<tr>
				  <th scope= $scope>$idEditCad</th>
				  <td>$nomePalestrante</td>
				  <td>$email</td>
				  <td> <a href= $hrefCertificado> <button type= $type class=$class name=$nameDelete id=$idDelete>$certificado</button></a></td>
				  <td> <a href= $hrefDelete> <button type= $type class=$class name=$nameDelete id=$idDelete>$deletar</button></a></td>
				  </tr>";	
				$pos++;
            }

        } catch (Exception $e) {
            Log::getInstance()->inserir(LOCAL_DPA,"Erro - " . $e->getCode() . " - " . $e->getMessage());
        }
	}

	

	function matricular($idPalestrante){
		try {
            $sql = "SELECT * FROM curso";
            $stmt = Conexao::getInstance()->prepare($sql);
			$stmt->execute();
			$col_md_4 = "form-group col-md-3";
			$scope = "row";
        	$type = "submit";
            $class = "btn btn-primary";
			$editar= "Inscrever-se";
			$form_horinzontal = "form-horizontal";
			$post = "post";
			//
			$form = "form-control";
			$number = "number";
			$sala = "sala";
			$teste = "teste";
			$label = ".label";
			$placeholder = "N°_Sala";
			$pos = 1;
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
				
            	//printf("<br>".$pos."° %s (%s) - Nota Hersberg: %g <br>", $result['nome'], $result['matricula'], $result['nota_hersberg']);
				$nomeCurso = $result['nome'];
				$ch = $result['carga_horaria'];
				if($result['idTurno'] ==1){
						$turno = "MATUTINO";
				}else if($result['idTurno'] ==2){
						$turno = "VESPERTINO";
				}else{$turno = "NOTURNO";}
				$data = date('d-m-Y', strtotime($result['data']));
				$nameEditar = $nomeCurso;
				$idEditar = $result['idCurso'];
				$hrefEditar = "../acoes/ministrarCurso.php?idCurso=$idEditar&idPalestrante=$idPalestrante";
				
				//if($idAluno == $result['idAluno']){
				echo "<form role=$form class= $form_horinzontal action=$hrefEditar method=$post> 
				<tr>
				  <th scope= $scope>$idEditar</th>
				  <td>$nomeCurso</td>
				  <td>$ch</td>
				  <td>$turno</td>
				  <td>$data</td>
				  <td><div class=$col_md_4>
				  <input type=$number class=$form name=$sala id=$sala placeholder=$placeholder required>
				  </div></td>
				  <td><button type= $type class=$class name=$nameEditar id=$idEditar>$editar</button></td>
				  </tr>
				  </form>";	
				$pos++;
			//}
			}
			return true;
        } catch (Exception $e) {
			Log::getInstance()->inserir(LOCAL_DPA,"Erro - " . $e->getCode() . " - " . $e->getMessage());
			return false;
        }

	}

}

//$da = DAOCargoDA::GetInstance()->select("Presidente");
//$curso = DAOCurso::GetInstance()->select(10);
//$Palestrante = new Palestrante(1509132 ,"Arthur Moura", 982103337, "arthur@email.com", 2015, 7.1, 0, 0, null, null, 0, 0,2400, 5, $curso);
//DAOPalestrante::getInstance()->insert($Palestrante);

//$Palestrante = DAOPalestrante::getInstance()->select(1509132);
//$Palestrante->setNome("Arthur");
//$Palestrante->setTelefone(982541354);
//$Palestrante->setIra(6.95);
//DAOPalestrante::getInstance()->update($Palestrante);

//Log::getInstance()->mostrar();


//DAOPalestrante::getInstance()->selectAll();

//

//




//




?>
