<?php 
	
	namespace app\core;
	use app\core\Registry;
	use app\core\QueryBuilder;
	/**
	* 
	*/
	class Validate
	{
		private $_passed = false;
		private $_errors = array();
		private $_db = null;

		function __construct()
		{
			$this->_db = Registry::getIntance();
		}
		public function check($source, $items = array()){
			foreach ($items as $item => $rules) {
				foreach ($rules as $rule => $rule_value) {
					//echo $item. " " .$rule. " phải có giá trị " .$rule_value ."<br>";
					$value = trim($source[$item]);
					//$item = escape($item);
					
					if ($rule === 'required' && empty($value)) {
						$this->addError($item." không được bỏ trống!");
					}elseif (!empty($value)) {
						switch ($rule) {
							case 'min':
								if (strlen($value) < $rule_value) {
									$this->addError($item." phải lớn hơn " .$rule_value);
								}
								break;
							case 'max':
								if (strlen($value) > $rule_value) {
									$this->addError($item." phải bé hơn " .$rule_value);
								}
								break;
							case 'matches':
								if ($value != $source[$rule_value]) {
									$this->addError($item." phải giống với " .$rule_value);
								}
								break;
							case 'unique':
								$value_new = "'".$value."'";
								$checks = QueryBuilder::table($rule_value)
										->where($item, '=', $value_new)
										->get();
								//echo $checks;
								$dem = 0;
								foreach ($checks as $key => $check) {
									$dem++;
								}
								if ($dem > 0) {
									$this->addError($item." đã tồn tại");
								}
								break;
							
							default:
								# code...
								break;
						}
					}
					else{
						
					}
				}
			}
			if (empty($this->_errors)) {
				$this->_passed = true;
			}
			return $this;
		}

		private function addError($error){
			$this->_errors[] = $error;
		}
		public function errors(){
			return $this->_errors;
		}
		public function passed(){
			return $this->_passed;
		}
	}

 ?>