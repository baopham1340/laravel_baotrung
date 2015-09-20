<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use lluminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\LHBS;

class LHBSController extends Controller
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
        $api_key = $request->get('api_key');
        $time = $request->get('time');
        if(LHBS::where('api_key',$api_key)->where('time',$time)->count()==0){
            try{
                $lhbs = new LHBS;
                $lhbs->api_key=$api_key;
                $lhbs->time=$time;
                $lhbs->doctor=$request->get('doctor');
                $lhbs->place=$request->get('place');
                $lhbs->reason=$request->get('reason');

                $lhbs->save();
                return response()->json(array(
                    'error' => false,
                    'message' => 'LHBS Created')
                );
            }
            catch(Exception $e){
                return response()->json(array(
                'error' => true,
                'message' => 'Error When Create LHBS')
            );
            }
        }
        else{
            return response()->json(array(
                'error' => true,
                'message' => 'Duplicate Time')
            );
        }
    }

    public function getLHBSbyApiKey($api_key){
        return response()->json(array(
            'error' => false,
            'lhbs' => LHBS::where('api_key',$api_key)->get()->toArray())
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
        $lhbs=LHBS::find($id);
        if($request->get('time')){
            $lhbs->time=$request->get('time');
        }
        if($request->get('doctor')){
            $lhbs->doctor=$request->get('doctor');
        }
        if($request->get('place')){
            $lhbs->place=$request->get('place');
        }
        if($request->get('reason')){
            $lhbs->reason=$request->get('reason');
        }
        $lhbs->save();
        return response()->json(array(
            'error' => false,
            'message' => 'LHBS Updated')
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
        LHBS::find($id)->delete();
        response()->json(array(
            'error' => true,
            'message' => 'LHBS Deleted')
        );
    }
}
