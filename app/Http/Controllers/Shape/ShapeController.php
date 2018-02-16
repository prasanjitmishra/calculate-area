<?php

namespace App\Http\Controllers\Shape;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Shapes\Rectangle;
class ShapeController extends Controller
{
	/**
	 * [getProperty description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function getAttributes(Request $request)
	{
		try {
		    $shape = ucwords($request->shapename);
		    $myclass = "\App\Shapes\\$shape";

			if (class_exists($myclass)) {
			    $myclass = new $myclass;
				return response()->json(['status'=>1,'message'=>'','data' => $myclass->getAttributes()]);
			} else {
				return response()->json(['status'=>0,'message'=>"class not found",'data' => NULL]);
			}
		} catch (Exception $e) {
			return response()->json(['status'=>0,'message'=>$e->getMessage(),'data' => NULL]);
		}
	}

	/**
	 * [calculateArea description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function calculateArea(Request $request)
	{
		try {
		    $shape = ucwords($request->shapename);
		    $myclass = "\App\Shapes\\$shape";
		    $requestData = $request->all();

			if (class_exists($myclass)) {
			    $myShape = new $myclass;
			    
			    if (!$myShape->validate($requestData)) {
					return response()->json(['status'=>0,'message'=>"error",'data' => $myShape->error]);
			    }

				return response()->json(['status'=>1,'message'=>'','data' => $myShape->calculateArea($requestData)]);
			} else {
				return response()->json(['status'=>0,'message'=>"class not found",'data' => NULL]);
			}
		} catch (Exception $e) {
			return response()->json(['status'=>0,'message'=>$e->getMessage(),'data' => NULL]);
		}
	}
}