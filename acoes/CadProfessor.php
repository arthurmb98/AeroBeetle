<?php

include"../seguranca/seguranca.php";

require_once '../dao/DAOProfessor.php';

$nome = $_POST['nome'];

$professor = new Professor($nome);

$valor = DAOProfessor::getInstance()->insert($professor);

if($valor){

	echo"<script>
				alert('Professor inserido com sucesso!');
    			window.location.href='../professor_crud/';
				</script>";	
}

else{
		echo"<script>
				alert('Não foi possível inserir esse Professor. Por favor, verifique os dados novamente!');
    			window.location.href='../professor_crud/';
				</script>";	
}


?>