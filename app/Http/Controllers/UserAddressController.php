<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAddress;
use DB;
use App\Http\Requests\UserAddressRequest;

class UserAddressController extends Controller
{
    //
    public function index(Request $request)
    {
    	// DB::enableQueryLog();
    	// $res = $request->user()->addresses;
    	// dd(DB::getQueryLog());die;
    	return view('user_addresses.index', [
    		'addresses' => $request->user()->addresses,
    	]);
    }

    public function create()
    {
    	return view('user_addresses.create_and_edit', ['address' => new UserAddress]);
    }
    					  
    public function store(UserAddressRequest $request)
    {
    	$request->user()->addresses()->create($request->only([
		'province',
		'city',
		'district',
		'address',
		'zip',
		'contact_name',
		'contact_phone',
		]));

		return redirect()->route('user_addresses.index');
    }
}
