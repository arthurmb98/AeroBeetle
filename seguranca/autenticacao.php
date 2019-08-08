<?php
session_cache_expire(60);
session_start();

//nome de sessão diferente para cada usuário
session_name(md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']));


require_once 'Usuario.php';

function valida(){ 
	$usuario = new Usuario();

	$user = "";
	$pass = "";


	$_COOKIE['nomeUser'] = $_POST['usuario'];

	if(isset($_POST['usuario']) AND isset($_POST['senha'])){ //Pega os valores POST do html
		$user = $_POST['usuario'];
		$pass = $_POST['senha'];
	}

	if(!isset($_SESSION['usuario']) OR !isset($_SESSION['senha'])){ //Inicia uma sessão
		$_SESSION['usuario'] = $user;
		$_SESSION['senha'] = $pass;
	}

	else if(isset($_SESSION['usuario']) AND isset($_SESSION['senha'])){ 
		$user = $_SESSION['usuario'];
		$pass = $_SESSION['senha'];
	}

	if(empty($_SESSION['usuario']) AND empty($_SESSION['senha'])){ //Se o usuário não estiver logado é expulso da página.
		echo"<script>
		alert('Você não está logado!');
    	window.location.href='../index.html';
		</script>";	
		session_destroy();
	}

	$valor = false;

	if(!isset($_SESSION['logado'])){
		$valor = $usuario->login($user, $pass);
		if($valor == true){ // Se tiver logado com sucesso...
			$_SESSION['logado'] = true;
			$_SESSION['nivel'] = $usuario->getNivel();  // Recebe o nível de acesso do usuário...
		}
		else{
			$_SESSION['logado'] = false;
			session_destroy();
		}
	}
	
	if($valor == false){ // Se não tiver efetuado o login com sucesso...
		echo"<script>
		alert('Usuário ou Senha Incorretos!');
    	window.location.href='../index.html';
		</script>";	
		$_SESSION['logado'] = false;
		session_destroy();		
	}

	//Informa o IP de quem está logando no sistema...

	if($_SESSION['logado'] == true){
		$_SESSION['donoSessao'] =  md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
	}

	// Usar esse código a cada chamada de uma nova página...
	//Validação de IP
	$tokenUser = md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);

	if($_SESSION['donoSessao']  != $tokenUser){
	  echo"<script>
      window.location.href='../index.html';
	  </script>";
	}

	// End.
}

function sair(){
	session_destroy();
}

valida();

?>