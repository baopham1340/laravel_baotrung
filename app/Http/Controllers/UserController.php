<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use Hash;

class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $username = $request->get('username');

        if (!$this->isUserExists($username)) {
            // Generating password hash
            $pass_hash = Hash::make($request->get('password'));
            $api_key = $this->generateApiKey();
    
            // insert query
            try{
                /*DB::table('users')->insert( 
                    ['api_key' => $api_key
                    , 'username' => $username
                    , 'pass_hash' => $pass_hash
                    , 'email' => $email
                    , 'sdt' => $sdt]
                    );*/
                User::create(array(
                    'api_key' => $api_key,
                    'username' => $username,
                    'pass_hash' => $pass_hash,
                    'email' => $request->get('email'),
                    'sdt' => $request->get('sdt')
                ));

                return response()->json(array(
                    'error' => false,
                    'message' => 'User Created')
                );
            }
            catch(Exception $e){
                return response()->json(array(
                    'error' => true,
                    'message' => 'Error When Create User')
                );
            }
        } else {
            // User with same email already existed in the db
            return response()->json(array(
                    'error' => true,
                    'message' => 'User Already Exist')
                );
        }
    }

    private function isUserExists($username) {
        $num_rows = User::where('username',$username)->count();
        return $num_rows > 0;
    }

    private function generateApiKey() {
        return md5(uniqid(rand(), true));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        $user=User::find($id);
        if($user)
            return response()->json(array(
                'error' => false,
                'user' => $user->get()->toArray())
            );
        else
            return response()->json(array(
                'error' => true,
                'message' => 'User Not Found')
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);
        if($user){
        
            if($request->get('password')){
                $user->pass_hash = PassHash::hash($request->get('password'));
            }
            if($request->get('email')){
                $user->email = $request->get('email');
            }
            if($request->get('sdt')){
                $user->sdt = $request->get('sdt');
            }
            $user->save();
            return response()->json(array(
                'error' => false,
                'message' => 'User Updated')
            );
        }
        else
            return response()->json(array(
                'error' => true,
                'message' => 'User Not Found')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $user =  User::find($id);
        if($user){
            $user->delete();
            return response()->json(array(
                'error' => false,
                'message' => 'User Deleted')
            );
        }
        else
            return response()->json(array(
                'error' => true,
                'message' => 'User Not Found')
            );
    }
}
