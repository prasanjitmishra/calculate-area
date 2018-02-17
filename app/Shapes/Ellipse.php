<?php
	namespace App\Shapes;
	
	use App\Shapes\Shape;
	use Illuminate\Support\Facades\Validator;
	
	class Ellipse extends Shape
	{
		private $height;
		private $width;
		public $error;
		
		/**
		 * [getAttributes returns an array containing the name of attributes the shape has as string ]
		 * @return [array] [array of strings]
		 */
		public function getAttributes()
		{
			return array('height','width');
		}
		
		/**
		 * [calculateArea function for calcuation of area]
		 * @param  [array] $data [array containing the value of the attributes]
		 * @return [float]       [calculated area]
		 */
		public function calculateArea()
		{
			return 3.14 * (float)$this->height * (float)$this->width;
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
                'height' => array('required', "regex:$regex"),
                'width'  => array('required', "regex:$regex"),
	        ]);

	        $this->error = $validator->errors()->all();

	        if(count($this->error) > 0){
	        	$this->error = implode($validator->errors()->all());
	            return false;
	        }

	        $this->height = $data['height'];
	        $this->width = $data['width'];
	    
	        return true;
		}
	}
?>