<?php
	session_start();
	ini_set( 'display_errors', 0 );

	if($_SESSION['logado'] == false OR !isset($_SESSION['logado'])){
		echo"<script>
		alert('Você não está logado!');
        window.location.href='../index.html';
		</script>";	
		session_destroy();
	}

	//Validação de IP
	$tokenUser = md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);

	if($_SESSION['donoSessao']  != $tokenUser){
	  echo"<script>
      window.location.href='../index.html';
	  </script>";
	  session_destroy();
	}

?>