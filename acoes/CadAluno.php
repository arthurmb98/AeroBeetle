<?php
//include"../seguranca/seguranca.php";

require_once '../dao/DAOAluno.php';

$nome = $_POST['nome'];
$matricula = $_POST['matricula'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$periodo = $_POST['periodo'];
$graduacao = $_POST['graduacao'];
$ano_inicial = null;


$aluno = new Aluno($nome, $matricula, $email, $telefone, $ano_inicial, $periodo, $graduacao);

if(!isset($_GET['idAluno'])){
	$valor = DAOAluno::getInstance()->insert($aluno);

//DAOAluno::getInstance()->selectAll();

	if($valor){

		echo"<script>
				alert('Aluno inserido com sucesso!');
    			window.location.href='../aluno_crud/add.php';
				</script>";	
	}

	else{
		echo"<script>
				alert('Não foi possível inserir esse Aluno. Por favor, verifique os dados novamente!');
    			window.location.href='../aluno_crud/add.php';
				</script>";	
	}

}else{
	$aluno->setIdAluno($_GET['idAluno']);

	$valor = DAOAluno::getInstance()->update($aluno);


if($valor){

	echo"<script>
				alert('Aluno alterado com sucesso!');
				</script>";	
}

else{
		echo"<script>
				alert('Não foi possível alterar esse Aluno. Por favor, verifique os dados novamente!');
				</script>";	
}

}


?>