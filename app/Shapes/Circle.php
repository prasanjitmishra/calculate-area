<?php
	namespace App\Shapes;
	
	use App\Shapes\Shape;
	use Illuminate\Support\Facades\Validator;

	class Circle extends Shape
	{
		private $diameter;
		public $error;
		
		public function getAttributes()
		{
			return array('diameter');
		}
		public function calculateArea($data)
		{
			return 3.14 * (float)$data['diameter'] * (float)$data['diameter'] / 4;
		}

		public function validate($data)
		{
			$regex = '/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/';

			$validator = Validator::make($data, [
                'diameter' => array('required',"regex:$regex")
	        ]);

	        $this->error = $validator->errors()->all();

	        if(count($this->error) > 0){
	        	$this->error = implode($validator->errors()->all());
	            return false;
	        }

	        return true;
		}
	}
?>