<?php
//include"../seguranca/seguranca.php";

require_once '../dao/DAOPalestrante.php';

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];


$Palestrante = new Palestrante($nome, $cpf, $email, $telefone);

if(!isset($_GET['idPalestrante'])){
	$valor = DAOPalestrante::getInstance()->insert($Palestrante);

//DAOPalestrante::getInstance()->selectAll();

	if($valor){

		echo"<script>
				alert('Palestrante inserido com sucesso!');
    			window.location.href='../palestrante_crud/add.php';
				</script>";	
	}

	else{
		echo"<script>
				alert('Não foi possível inserir esse Palestrante. Por favor, verifique os dados novamente!');
    			window.location.href='../palestrante_crud/add.php';
				</script>";	
	}

}else{
	$Palestrante->setIdPalestrante($_GET['idPalestrante']);

	$valor = DAOPalestrante::getInstance()->update($Palestrante);


if($valor){

	echo"<script>
				alert('Palestrante alterado com sucesso!');
				</script>";	
}

else{
		echo"<script>
				alert('Não foi possível alterar esse Palestrante. Por favor, verifique os dados novamente!');
				</script>";	
}

}


?>