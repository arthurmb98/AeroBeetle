<?php

require_once 'Log.php';

define('LOCAL_S', "Conexao.php");
class Conexao {
	private static $instance;

	function __construct()
	{
		//empty
	}
	
	public function getInstance()
	{
		if (!isset(self::$instance) || self::$instance != null) {
			
			$dsn = 'mysql:host=localhost;dbname=id7350926_aerobeetle';
			$user = 'id7350926_pitagoras';
			$senha = 'q1w2e3r4';

			try {
				self::$instance = new PDO($dsn, $user, $senha);
            	self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           	 	self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
           	 	
			} catch (Exception $e) {
				Log::getInstance()->inserir(LOCAL_S,("Erro ao conectar - ".$e->getCode()." - ".$e->getMessage()));
				return null;
			}
            
        }
        Log::getInstance()->inserir(LOCAL_S,"Conectado ao banco...");
        return self::$instance;
	}

	public function close()
	{
		self::$instance = null;
		Log::getInstance()->inserir(LOCAL_S,"Desconectado ao banco...");

	}

}

// $conn = Conexao::getInstance();
// Conexao::close();
// $conn = Conexao::getInstance();
// $conn = Conexao::getInstance();
// $conn = Conexao::getInstance();
// Log::getInstance()->mostrar();

?>