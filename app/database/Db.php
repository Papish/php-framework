<?php
class Db {

	private $_connection;
	private $_query;
	private $_count;
	private $_result;
	private $_error;

	private $_hostname;
	private $_username;
	private $_password;
	private $_database;

	private $_select;
	private $_delete;
	private $_table_from;
	private $_where;
	private $_limit;
	private $_orderby;

	public function __construct($db) {
		if(empty($db)) { 
			throw new Exception("Database configuration failed to load");
		}
		$this->_hostname = $db['host'];
		$this->_username = $db['user'];
		$this->_password = $db['pass'];
		$this->_database = $db['dbname'];
		$this->connect();
	}

	private function connect() {
		if(empty($this->_hostname)) {
			throw new Exception("No any such host found");
		}
		$dsn = "mysql:host=$this->_hostname;dbname=$this->_database";
		try {
			$this->_connection = new PDO($dsn, $this->_username, $this->_password);
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
		return $this;
	}

	/*
	* Database query formatter
	*/
	public function select($select) {
		return $this->_select = $select;
	}

	public function from($table_name) {
		return $this->_table_name = $table_name;
	}

	public function delete($table_name) {
		return $this->_delete = $table_name;
	}

	public function update() {

	}
	
	public function where($data) {
		return $this->_where = $data;
	}

	public function orderby() {

	}

	public function limit() {

	}

	public function offset() {

	}

	public function get() {
		if(!empty($this->_select) AND !empty($this->_table_name)) {
			$this->select_query();
		}
		elseif(!empty($this->_delete) AND !empty($this->_where)) {
			$this->delete_qeury();
		}
	}

	/*
	* Select query formatter
	*/
	private function select_query() {
		if(empty($this->_where)) {
			$sql = "SELECT {$this->_select} FROM {$this->_table_name}";
		}
		else {
			$where = $this->array_builder();
			$sql = "SELECT {$this->_select} FROM {$this->_table_name} WHERE " . implode(" ", $where);
		}
		$this->query_execute($sql);
		$this->reset();
	}

	/*
	* Delete query formatter
	*/
	private function delete_qeury() {
		$where = $this->array_builder();
		$sql = "DELETE FROM {$this->_delete} WHERE " . implode(" ", $where);
		$this->query_execute($sql);
		$this->reset();
	}

	/*
	* Core class function
	* array builder for where clause only
	* @return array as for query with AND format
	*/
	private function array_builder() {
		if(is_array($this->_where)) {
			foreach ($this->_where as $key => $param) {
				$field[] = $key;
				$value[] = $param;
			}
			$where = array();
			$where[0] = "$field[0]" . " = " . "'$value[0]'";
			if(count($this->_where) > 1) {
				for($x = 1; $x < count($this->_where); $x++) {	
					$where[$x] = "AND $field[$x]" . " = " . "'$value[$x]'";
				}
			}
		}
		return $where;
	}

	// execute sql query
	private function query_execute($sql) {
		$this->_query = $this->_connection->prepare($sql);
		$this->_query->execute();
		$this->_count = $this->_query->rowCount();
		$this->_result = $this->_query->fetch(PDO::FETCH_ASSOC);
	}

	// @return count
	public function count() {
		return $this->_count;
	}

	// @return fetched data
	public function result() {
		return $this->_result;
	}

	// reset PDO query and its params
	public function reset() {
		$this->_where = array();
		$this->_orderby = array();
		$this->_query = null;
		$this->_table_name = "";
	}
}
?>
$SERVER['SERVER_ADDR']