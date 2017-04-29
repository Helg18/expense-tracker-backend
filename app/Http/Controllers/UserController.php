<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\User;

class UserController extends Controller
{
    public function registerNewUser(UserCreateRequest $request){
    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->save();

    	return response()->json(['msg' => 'Usuario creado con exito'], 200);
    }
}
