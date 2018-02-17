<?php
	namespace App\Shapes;
	
	use App\Shapes\Shape;
	use Illuminate\Support\Facades\Validator;
	
	/**
	 * Rightangledtriangle class extending the Parent class
	 */
	class Rightangledtriangle extends Shape
	{
		public $error;
		private $height;
		private $base;

		/**
		 * [getAttributes returns an array containing the name of attributes the shape has as string ]
		 * @return [array] [array of strings]
		 */
		public function getAttributes()
		{
			return array('height','base');
		}
		
		/**
		 * [calculateArea function for calcuation of area]
		 * @return [float]       [calculated area]
		 */
		public function calculateArea()
		{
			return 0.5 * (float)$this->height * (float)$this->base;
		}

		/**
		 * [validate validates the data sent by you from the front end, set the error variable if not validate the data]
		 * @param  [object] $data [data sent to calculate area containing attribute values]
		 * @return [boolean]       [true/ false vbased on the validation rule]
		 */
		public function validate($data)
		{
			$regex = '/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/';
			$validator = Validator::make($data, [
                'height' => array("required","regex:$regex"),
                'base'  => array('required',"regex:$regex")
	        ]);

	        $this->error = $validator->errors()->all();

	        if(count($this->error) > 0){
	        	$this->error = implode($validator->errors()->all());
	            return false;
	        }

	        $this->height = $data["height"];
	        $this->base = $data["base"];

	        return true;
		}
	}
?>