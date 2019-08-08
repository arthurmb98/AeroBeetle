<?php
include ("autenticacao.php");

ini_set( 'display_errors', 0 );

if($_SESSION['logado']){
	
	if($_SESSION['nivel'] > 0){ // Loga como usuário padrão
	  echo"<script>
      window.location.href='../tela_inicial.php';
	  </script>";
	}

}

	else{ // Caso contrário é expulso da página...
		echo"<script>
     	window.location.href='../index.html';
		</script>";	
		session_destroy();
	}

	//Validação de IP
	$tokenUser = md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);

	if($_SESSION['donoSessao']  != $tokenUser){
	  echo"<script>
      window.location.href='../index.php';
	  </script>";
	  session_destroy();
	}
	
?>