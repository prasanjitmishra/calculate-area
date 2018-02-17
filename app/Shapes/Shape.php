<?php  
	namespace App\Shapes;
	/**
	 * Parent class of all shapes
	 */
	class Shape
	{
		/**
		 * [getAttributes abstract function for returning the name of attributes the shape has]
		 * @return [array] [array containing the attribute names as string]
		 */
		public function getAttributes(){}
		/**
		 * [calculateArea abstract function for calcuation of area]
		 * @return [integer]       [area calculated from formula]
		 */
		public function calculateArea(){}
	}
?>