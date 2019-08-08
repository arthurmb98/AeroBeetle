<?php

require_once 'Conexao.php';
require_once 'Log.php';
//

define('LOCAL_SU', 'Usuario.php');

class Usuario{

	//private static $instance;

    private $login;
    private $senha;
    private $nivel;

	function __construct()
	{
	}

    //GET
    public function getLogin(){
        return $this->login;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function getNivel(){
        return $this->nivel;
    }

    //


	public function login($user, $pass){
		try {
            $sql = "SELECT nivel_acesso FROM usuario WHERE login = ? AND senha = ?";
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindParam(1, $user);
            $stmt->bindParam(2, $pass);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
             if(empty($row) == false){
                $this->login = $user;
                $this->senha = $pass;
                $this->nivel = $row['nivel_acesso'];        
                Log::getInstance()->inserir(LOCAL_SU,"LOGIN do Usuario executado...");
             	return true;
             }
            if($user == null || $pass == null){
             	echo"<script>
				alert('Você não está logado!');
    			window.location.href='../index.html';
				</script>";	
             	return false;
             }
             else{
             	echo"<script>
				alert('Usuário ou Senha Incorretos!');
    			window.location.href='../index.html';
				</script>";	
             	return false;
             }

        } catch (Exception $e) {
            Log::getInstance()->inserir(LOCAL_SU,"Erro - " . $e->getCode() . " - " . $e->getMessage());
            echo"<script>
				alert('Falha!!!');
    			window.location.href='../index.html';
				</script>";	
            return false;
        }
	}

    public function sair(){
        session_destroy();
    }
}

?>