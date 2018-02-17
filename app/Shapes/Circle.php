<?php
	namespace App\Shapes;
	
	use App\Shapes\Shape;
	use Illuminate\Support\Facades\Validator;

	/**
	 * Circle class extending the Parent class
	 */
	class Circle extends Shape
	{
		private $diameter;
		public $error;
		
		/**
		 * [getAttributes returns an array containing the name of attributes the shape has as string ]
		 * @return [array] [array of strings]
		 */
		public function getAttributes()
		{
			return array('diameter');
		}

		/**
		 * [calculateArea function for calcuation of area]
		 * @param  [array] $data [array containing the value of the attributes]
		 * @return [float]       [calculated area]
		 */
		public function calculateArea()
		{
			return 3.14 * (float)$this->diameter * (float)$this->diameter / 4;
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
                'diameter' => array('required',"regex:$regex")
	        ]);

	        $this->error = $validator->errors()->all();

	        if(count($this->error) > 0){
	        	$this->error = implode($validator->errors()->all());
	            return false;
	        }

	        $this->diameter = $data["diameter"];

	        return true;
		}
	}
?>