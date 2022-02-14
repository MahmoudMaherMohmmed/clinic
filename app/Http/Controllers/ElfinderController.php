<?php namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 

class ElfinderController extends Controller {
	public function getIndex( Request $request )
	{
		$data = array();		
		if(!is_null($request->get('cmd')))
		{
			return view('elfinder.connector',$data);
		} else {
			return view('elfinder.filemanager',$data);
		}
	}
	
	static function display()
	{
		return view('elfinder.filemanager');	
	} 
}