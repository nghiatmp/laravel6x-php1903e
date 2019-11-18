<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class Demo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'name' => 'AAA',
            'age'  => 20
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json([
            'id' => 1,
            'money'  => 123
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'id' => $id,
            'info' => [
                'name' => 'LMN',
                'email' => 'test'
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $arrData = json_decode(json_encode($data),true);
        //
         return response()->json([
            'id' => $id,
            'info' => $arrData
         ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $del= Admin::deleteDataByID($id);

         if($del){
                return response()->json([
                'mess' =>'success'
             ]);
         }else{
               return response()->json([
                'mess' =>'fail'
             ]);
        }
         
    }
}
