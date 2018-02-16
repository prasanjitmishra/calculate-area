<?php
	namespace App\Shapes;
	
	use App\Shapes\Shape;
	use Illuminate\Support\Facades\Validator;

	class Square extends Shape
	{
		private $diameter;
		public $error;
		
		public function getAttributes()
		{
			return array('width');
		}
		public function calculateArea($data)
		{
	        
			return (float)$data['width'] * (float)$data['width'];
		}

		public function validate($data)
		{
			$regex = '/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/';
			
			$validator = Validator::make($data, [
                'width'  => array('required', "regex:$regex"),
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