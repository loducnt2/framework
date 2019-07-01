<?php 
	namespace app\core;
	/**
	* 
	*/
	class Model
	{
		protected static $table;

		function __construct()
		{
			//$this->connect_database();
		}
		public function connect_database(){
			$connection = mysqli_connect("localhost", "root", "", "framework");
			if (!$connection) {
	            die("Lỗi kết nối tới database");
	        }
        	return $connection;
		}


		public function save(){
			$conn = $this->connect_database();

	        // Lấy ra giá trị của tất cả các thuộc tính của object hiện tại theo dạng array
	        $data = get_object_vars($this);
	        /*print_r($data);
			die();*/
			unset($data['table']); 
			/*print_r($data);
			die();*/

	        $keys = array_keys($data);
	        /*print_r($keys);
	        echo "<br>";*/
	        
	        $values = array_values($data);
	        //print_r($values);


	        $sql = "INSERT INTO " .static::$table ."(" . implode(", ", $keys) . ") " . "VALUES (";

	        $dem2 = 0;
	        $space = ', ';
	        foreach ($values as $key => $value) {
				$value = "'".$value."'";
				$arr[$key] = $value;
			}
			foreach ($arr as $key => $value) {
				$sql .= $value;
				$dem2++;
				if ($dem2 < count($values)) {
					$sql .= $space;
				}
			}
			$sql .= ')';
	        //echo $sql;

	        //return $sql;

	       	$result = mysqli_query($conn, $sql);
	        return $result;
		}
		public function update(){
			$conn = $this->connect_database();

	        $data = get_object_vars($this);
	        /*print_r($data);
			die();*/
			unset($data['table']); 
			/*print_r($data);
			die();*/

	        $keys = array_keys($data);
	        /*print_r($keys);
	        echo "<br>";*/
	        
	        $values = array_values($data);
	        //print_r($values);


	        $sql = "UPDATE " .static::$table ." SET name = 'Alfred Schmidt', price= 123, description= 'Frankfurt' ";

	        //echo $sql;

	        //return $sql;

	       	$result = mysqli_query($conn, $sql);
	        return $result;
		}
		
		public static function all(){
			$conn = self::connect_database();
			$sql = "SELECT * FROM " .static::$table;
			//echo $sql;
			$result = mysqli_query($conn, $sql);
	        return $result;
		}

		public static function where($value1, $value2){
			echo "Day là func where của " .static::$table . "<br>";

			$value_new = "'".$value2."'";

			$conn = self::connect_database();
			$sql = "SELECT * FROM " .static::$table . " WHERE ".$value1 ." = " .$value_new;

			//echo $sql;
			$result = mysqli_query($conn, $sql);
	        return $result;
		}

		public static function find($id){
			$conn = self::connect_database();
			$sql = "SELECT * FROM " .static::$table . " WHERE id = " .$id;
			//echo $sql;
			$result = mysqli_query($conn, $sql);
	        return $result;
		}

		public static function deleteById($id){
			echo "delete by id";
			$conn = self::connect_database();
			$sql = "DELETE FROM " .static::$table . " WHERE id = " .$id;
			// /echo $sql;
			$result = mysqli_query($conn, $sql);
	        return $result;
		}
		public function delete(){
			//echo "delete by id";
			$conn = self::connect_database();
			$sql = "DELETE FROM " .static::$table;
			echo $sql;
			/*$result = mysqli_query($conn, $sql);
	        return $result;*/
		}
		public static function first(){
			echo "Hàm select first: " . "<br/>";
			$conn = self::connect_database();
			$sql = "SELECT * FROM " .static::$table ." LIMIT 1";
			//echo $sql;
			$result = mysqli_query($conn, $sql);
	        return $result;
		}
		public static function last(){
			echo "Hàm select last: " . "<br/>";
			$conn = self::connect_database();
			$sql = "SELECT * FROM " .static::$table ." ORDER BY id DESC LIMIT 1";
			//echo $sql;
			$result = mysqli_query($conn, $sql);
	        return $result;
		}
		
		public static function count(){
			echo "Hàm count";
			$conn = self::connect_database();
			$sql = "SELECT COUNT(*) FROM " .static::$table;
			$result = mysqli_query($conn, $sql);
	        return $result;
		}


	}

 ?>