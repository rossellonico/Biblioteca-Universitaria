<?php

class Database {
	private $res;
	private $cn = false;
	private static $instance = false;

	private function __construct() { }

	public static function getInstance() {
		if(! self::$instance) self::$instance = new Database;
		return self::$instance;
	}


	private function connectIfNotConnected() {
		if(!$this->cn) 
			$this->cn = mysqli_connect("localhost", "root", "", "biblioteca");
	}

	public function query($q) {
		$this->connectIfNotConnected();
		$this->res = mysqli_query($this->cn, $q);
		if(mysqli_error($this->cn) != "") {
			die("ERROR CONSULTA $q --- " . mysqli_error($this->cn));
		}
	}

	public function fetch() {
		if(!$this->res) throw new Exception("no se puede hacer fetch sin resultados");
		return mysqli_fetch_assoc($this->res);
	}

	public function fetchAll(){
		$aux = array();
		while($fila = $this->fetch()) $aux[] = $fila;
		return $aux;
	}

	public function numRows() {
		return mysqli_num_rows($this->res);
	}

	public function escapeString($str) {
		$this->connectIfNotConnected();
		return mysqli_escape_string($this->cn, $str);
	}
	
	public function escapeWildcards($str) {
		$str = str_replace('%', '\%', $str);
		$str = str_replace('_', '\_', $str);
		return $str;
	}


	public function insertID(){
		return mysqli_insert_id($this->cn);
	}


}