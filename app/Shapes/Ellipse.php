<?php
	namespace App\Shapes;
	
	use App\Shapes\Shape;
	use Illuminate\Support\Facades\Validator;
	
	class Ellipse extends Shape
	{
		private $height;
		private $width;
		public $error;
		
		public function getAttributes()
		{
			return array('height','width');
		}
		
		public function calculateArea($data)
		{
			return 3.14 * (float)$data['height'] * (float)$data['width'];
		}

		public function validate($data)
		{
			$regex = '/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/';

			$validator = Validator::make($data, [
                'height' => array('required', "regex:$regex"),
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