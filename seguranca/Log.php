<?php

/**
* 
*/
class Log
{
	private static $instance;
	private static $log;
	private static $line;

	public function _construct()
	{
		
	}

	public function getInstance()
	{
		if (!isset(self::$instance)) {
			self::$instance = new Log();
			self::$line = 0;
		}

		return self::$instance;
	}

	public function inserir($local, $msg)
	{

		self::$log .= self::$line.". ".$local." - ".$msg . "</br>";
		self::$line++;
	}

	public function mostrar()
	{
		echo self::$log;
	}

}

?>