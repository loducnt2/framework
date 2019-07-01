<?php
	namespace app\core;

	// Sử dụng thư viện kết nối CSDL 
	use \PDO;
	use \PDOException;
	use app\core\Registry;

	/**
	* 
	*/
	class QueryBuilder
	{
		private $fromTable;
		private $selectColumns;
		private $distinct = false;
		private $joins;
		private $wheres;
		private $groups;
		private $havings;
		private $orders;
		private $limit;
		private $offset;
		private $deletes;
		private $id_find;

		private $insertColumns;
		private $updateColumns;

		private $database_name = "framework";
	    private $database_host = "localhost";
	    private $database_username = "root";
	    private $database_password = "";
	    private $connection;

		
		function __construct($tableName)
		{
			$this->fromTable = $tableName;
			$this->connect_database();
		}

		public function connect_database(){
			$this->connection = mysqli_connect($this->database_host, $this->database_username, $this->database_password, $this->database_name);
			if (!$this->connection) {
	            die("Lỗi kết nối tới database");
	        }
        	return $this->connection;
		}

		public static function table($tableName){
			return new QueryBuilder($tableName);
		}

		public function select($columns){
			$this->selectColumns = is_array($columns) ? $columns : func_get_args();
			return $this;
		}

		public function distinct(){
			$this->distinct = true;
			return $this;
		}

		public function join($table, $first, $operator, $second, $type='INNER'){
			$this->joins[] = [$table, $first, $operator, $second, $type];
			return $this;
		}
		public function leftjoin($table, $first, $operator, $second){
			return $this->join($table, $first, $operator, $second, 'LEFT');
		}
		public function rightjoin($table, $first, $operator, $second){
			return $this->join($table, $first, $operator, $second, 'RIGHT');
		}

		public function where($column, $operator, $value, $boolean = 'AND'){
			$this->wheres[] = [$column, $operator, $value, $boolean];
			return $this;
		}
		public function orWhere($column, $operator, $value){
			return $this->where($column, $operator, $value, 'OR');
		}

		public function groupBy($columns){
			$this->groups = is_array($columns) ? $columns : func_get_args();
			return $this;
		}

		public function having($column, $operator, $value, $boolean = 'AND'){
			$this->havings[] = [$column, $operator, $value, $boolean];
			return $this;
		}
		public function orHaving($column, $operator, $value){
			return $this->having($column, $operator, $value, 'OR');
		}

		public function orderBy($column, $direction = 'ASC'){
			$this->orders[] = [$column, $direction];
			return $this;
		}

		public function limit($limit){
			$this->limit = $limit;
			return $this;
		}

		public function offset($offset){
			$this->offset = $offset;
			return $this;
		}

		public function find($id){
			$this->id_find = $id;

			if (!isset($this->fromTable) || empty($this->fromTable)) {
				return false;
			}

			$sql = 'SELECT * FROM '.$this->fromTable;

			// id_find
			if (isset($this->id_find)) {
				$sql .= " WHERE id = $this->id_find";
			}
			//return $sql;

			$this->connection = $this->connect_database();
			$result = mysqli_query($this->connection, $sql);
			return $result;
		}
		

		public function get(){
			if (!isset($this->fromTable) || empty($this->fromTable)) {
				return false;
			}
			// DISTINCT
			$sql = $this->distinct ? 'SELECT DISTINCT' : 'SELECT';

			// SELECT
			if(isset($this->selectColumns) && is_array($this->selectColumns)){
				$sql .= ' '.implode(', ', $this->selectColumns);
			}else{
				$sql .= ' *';
			}

			// FROM
			$sql .= ' FROM '.$this->fromTable;

			// JOIN
			if(isset($this->joins) && is_array($this->joins)){
				foreach ($this->joins as $key => $join) {
					switch (strtolower($join[4])) {
						case 'inner':
							$sql .= ' INNER JOIN';
							break;
						case 'left':
							$sql .= ' LEFT JOIN';
							break;
						case 'right':
							$sql .= ' RIGHT JOIN';
							break;
						default:
							$sql .= ' INNER JOIN';
							break;
					}
					$sql .= " $join[0] ON $join[1] $join[2] $join[3]";
				}
			}

			// WHERE
			if(isset($this->wheres) && is_array($this->wheres)){
				$sql .= ' WHERE';
				foreach ($this->wheres as $keywh => $where) {
					$sql .= " $where[0] $where[1] $where[2]";
					if ($keywh < count($this->wheres) - 1) {
						$sql .= ($where[3] == 'AND') ? ' AND' : ' OR';
					}
				}
			}

			// groupBy
			if(isset($this->groups) && is_array($this->groups)){
				$sql .= ' GROUP BY ' .implode(' ,', $this->groups);
			}

			// HAVING
			if(isset($this->havings) && is_array($this->havings)){
				$sql .= ' WHERE';
				foreach ($this->havings as $keyHa => $having) {
					$sql .= " $having[0] $having[1] $having[2]";
					if ($keyHa < count($this->havings) - 1) {
						$sql .= ($having[3] == 'AND') ? ' AND' : ' OR';
					}
				}
			}

			// ORDER 
			if(isset($this->orders) && is_array($this->orders)){
				$sql .= ' ORDER BY';
				foreach ($this->orders as $keyOr => $order) {
					$sql .= " $order[0] $order[1]";
					if ($keyOr < count($this->orders) - 1) {
						$sql .= ",";
					}
				}
			}

			// LIMIT
			if (isset($this->limit)) {
				$sql .= " LIMIT $this->limit";
			}

			// OFFSET
			if (isset($this->offset)) {
				$sql .= " OFFSET $this->offset";
			}

			
			//return $sql;

			$this->connection = $this->connect_database();
			$result = mysqli_query($this->connection, $sql);
			return $result;
		}

		public function insert($arrInsert){

			if (!isset($this->fromTable) || empty($this->fromTable)) {
				return false;
			}
			$this->insertColumns = is_array($arrInsert) ? $arrInsert : func_get_args();

			$in1 = $this->insertColumns;

			$sql = 'INSERT INTO '.$this->fromTable .' (';

			$dem = 0;
			$dem2 = 0;
			$space = ', ';
			foreach ($in1 as $key => $value) {
				$sql .= $key;
				$dem++;
				if ($dem < count($in1)) {
					$sql .= $space;
				}
			}
			$sql .= ') VALUES (';

			foreach ($in1 as $key => $value) {
				$value = "'".$value."'";
				$arr[$key] = $value;
			}
			foreach ($arr as $key => $value) {
				$sql .= $value;
				$dem2++;
				if ($dem2 < count($in1)) {
					$sql .= $space;
				}
			}
			$sql .= ')';

			//return $sql;
			$this->connection = $this->connect_database();
			$result = mysqli_query($this->connection, $sql);
			return $result;
		}

		public function update($arrays){

			if (!isset($this->fromTable) || empty($this->fromTable)) {
				return false;
			}
			$this->updateColumns = is_array($arrays) ? $arrays : func_get_args();

			$up1 = $this->updateColumns;

			$sql = 'UPDATE '.$this->fromTable .' SET ';
			$space = ', ';
			$dem = 0;
			foreach ($up1 as $key => $value) {
				$value = "'".$value."'";
				$arr[$key] = $value;
			}
			foreach ($arr as $key => $value) {
				$sql .= $key .' = ' .$value;
				$dem++;

				if ($dem < count($up1)) {
					$sql .= $space;
				}
			}
			if(isset($this->wheres) && is_array($this->wheres)){
				$sql .= ' WHERE';
				foreach ($this->wheres as $keywh => $where) {
					$sql .= " $where[0] $where[1] $where[2]";
					if ($keywh < count($this->wheres) - 1) {
						$sql .= ($where[3] == 'AND') ? ' AND' : ' OR';
					}
				}
			}
			//return $sql;

			$this->connection = $this->connect_database();
			$result = mysqli_query($this->connection, $sql);
			return $result;
		}
		public function delete(){
			if (!isset($this->fromTable) || empty($this->fromTable)) {
				return false;
			}

			$sql = 'DELETE FROM '.$this->fromTable;

			// WHERE
			if(isset($this->wheres) && is_array($this->wheres)){
				$sql .= ' WHERE';
				foreach ($this->wheres as $keywh => $where) {
					$sql .= " $where[0] $where[1] $where[2]";
					if ($keywh < count($this->wheres) - 1) {
						$sql .= ($where[3] == 'AND') ? ' AND' : ' OR';
					}
				}
			}
			//return $sql;

			$this->connection = $this->connect_database();
			$result = mysqli_query($this->connection, $sql);
			return $result;
		}

	}

?>