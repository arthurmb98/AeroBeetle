<?php

include"../seguranca/seguranca.php";

require_once '../dao/DAOAluno.php';

$valor = DAOAluno::getInstance()->delete($_GET['idButton']);

if($valor){

	echo"<script>
				alert('Aluno Deletado com sucesso!');
    			window.location.href='../listar/listAluno.php';
				</script>";	
}

else{
		echo"<script>
				alert('Não foi possível Deletar esse Aluno. Por favor, verifique os dados novamente!');
    			window.location.href='../listar/listAluno.php';
				</script>";	
}



?>