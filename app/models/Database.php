<?php
class Database {
	private $database_link;
	private $result;
	private $result_object;

	public function __construct($config) {
		$this->connect($config);
	}

	public function __destruct() {
		$this->close();
	}

	public function connect($config) {
		$this->database_link = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);
		
		if (!$this->database_link->connect_error) {
			if($this->database_link->set_charset($config['charset'])) {
				$this->database_link->query('SET NAMES utf8;');
				return true;
			} else {
				$this->close();
				return false;
			}
		} else {
			error_log('Connect Error (' . $this->database_link->connect_errno . ') ' . $this->database_link->connect_error);
			return false;
		}
	}

	public function close() {
		if($this->database_link !== null) {
			@$this->database_link->close();
			$this->database_link = null;
		}
	}

	public function get_database_link() {
		return $this->database_link;
	}

	// km'; TRUNCATE TABLE users; select * from users where email = 'asdas

	public function query($query) {
		$return_result = array('num_rows' => 0, 'affected_rows' => 0, 'result' => null);
		$this->result = $this->database_link->query($query);

		if(!$this->result) {
			$return_result['status'] = false;

			$return_result['mysqli_error_no'] = $this->database_link->errno;
			$return_result['mysqli_error'] = $this->database_link->error;

			var_dump($return_result); 
			exit(); 			

			error_log('Unable to run query ( Error: ' . $this->database_link->errno . ' Description: ' . $this->database_link->error . '), this was the supplied SQL: ' . $query);
		} else {
			$return_result['status'] = true;

			$return_result['num_rows'] = isset($this->result->num_rows) ? $this->result->num_rows : 0;
			$return_result['affected_rows'] = isset($this->result->affected_rows) ? $this->result->affected_rows : 0;

			if(strpos($query, 'SELECT') === 0) {
				$return_result['result'] = array();

				while($row = $this->result->fetch_assoc()) {
					$return_result['result'][] = $row;
				}
			} else {
				$return_result['result'] = $this->result;
			}
		}

		return $return_result;
	}

	public function insert_id() {
		if($this->database_link !== null) {
			return $this->database_link->insert_id;
		} 
		
		return false;
	}

	public function escape($string, $cslashes = true) {
		if($this->database_link !== null) {
			$result = $this->database_link->real_escape_string($string);

			if($cslashes === true) {
				$result = addcslashes($result, '%_');
			}

			return $result;
		} else {
			error_log('Unable to escape string because no active database connection was found.');
			return false;
		}
	}
}