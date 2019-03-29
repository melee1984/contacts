<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhoneBook extends Model
{
    //	
	use SoftDeletes;

    protected $table = 'phonebook';
	public $timestamps = true;
    // protected $softDelete = true;
	protected $dates = ['deleted_at'];

	public static function addRecord($request) {

        $rs = new PhoneBook;

    	$rs->name = $request->input('name');
    	$rs->email = $request->input('email');
    	$rs->phone = $request->input('phone');
    	$rs->country = $request->input('country');
    	$rs->city = $request->input('city');
    	$rs->postal_code = $request->input('postal_code');
    	$rs->state = $request->input('state');
    	$status = $rs->save();

    	if ($status) {

		}

    	return $status;
    }

    public static function updateRecord($request) {

        $rs = PhoneBook::find($request->input('id'));

        $rs->name = $request->input('name');
        $rs->email = $request->input('email');
        $rs->phone = $request->input('phone');
        $rs->country = $request->input('country');
        $rs->city = $request->input('city');
        $rs->postal_code = $request->input('postal_code');
        $rs->state = $request->input('state');

        $status = $rs->save();

        if ($status) {

        }

        return $status;

    }



}
