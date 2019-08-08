<?php

include"../seguranca/seguranca.php";

require_once '../dao/DAOCurso.php';

$nome = $_POST['nome'];
$turno= $_POST['turno'];
$ch = $_POST['carga_horaria'];
$data = $_POST['data'];

$curso = new Curso($nome, $turno, $ch, $data);

$valor = DAOCurso::getInstance()->insert($curso);

if($valor){

	echo"<script>
				alert('Curso inserido com sucesso!');
    			window.location.href='../curso_crud/';
				</script>";	
}

else{
		echo"<script>
				alert('Não foi possível inserir esse Curso. Por favor, verifique os dados novamente!');
    			window.location.href='../curso_crud/';
				</script>";	
}


?>