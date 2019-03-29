<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Phonebook;


class RequestController extends Controller
{
    //
     public function index() {
	    
	    $rs = array();

		$data_complete = array();

		$rs = Phonebook::all();

		foreach($rs as $list) {

			$data = array();

			$data['name'] = $list->name;
			$data['email'] = $list->email;
			$data['phone'] = $list->phone;
			$data['country'] = $list->country;
			$data['city'] = $list->city;
			$data['postal_code'] = $list->postal_code;
			$data['state'] = $list->state;

			array_push($data_complete, $data);
		}
	
		return response()->json(['record' => $data_complete]); 

	}

	public function show($id) {
        return Phonebook::find($id);
    }

    public function store(Request $request) {

    	$input = $request->all();

		$data = array();
		$dataExaminee = array();

		$request->validate(['name' => 'required',
		            'phone' => 'required',
		            'email' => 'required|email|unique:phonebook',
		            'country' => 'required',
		            'city' => 'required']
		       );

		$status = Phonebook::addRecord($request);

		if ($status)  {
			
		}

		return $this->index();

    }

    public function delete(Request $request, $id){

    		$rs = Phonebook::find($id);
    		$rs->delete();

			return $this->index();
   
    }


}
