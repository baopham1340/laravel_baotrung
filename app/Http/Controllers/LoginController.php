<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use lluminate\Http\Response;
use App\User;
use Hash;

class LoginController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($username,$password)
    {
        //
        $user = User::where('username',$username);
        if($user->count()>0 && Hash::check($password,$user->first()->pass_hash)){
            return response()->json(array(
                'error' => false,
                'api_key' => $user->first()->api_key)
            );
        }
        else{
            return response()->json(array(
                'error' => true,
                'message' => 'User Not Exists')
            );
        }
    }
}
