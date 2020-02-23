<?php

namespace App\Http\Controllers\API;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
USE config\logging;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $barang = DB::table('barang')->where('is_delete','=','0')
        // ->orderBy('nama_barang','ASC')->get();
        $customers =  DB::table('customer')->get();
        // print "tes customer ".$customers;
        // dd("tes customers".$customers);
        return response()->json([
            'status' => 'success',
            'customers'  => $customers,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validation = Validator::make($request->all(),[ 
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'contact_number' => 'required',
            'position' => 'required',
        ]);

        if($validation->fails()){
            return response()->json([
                'status' => 'error',
                'messages'  => $validation->errors(),
            ], 200);
        }
        else
        {
            $customer = new Customer;
            $customer->name = $request->input('name');
            $customer->email = $request->input('email');
            $customer->contact_number = $request->input('contact_number');
            $customer->save();
    
            return response()->json([
                'status' => 'success',
                'customer'  => $customer,
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $customer = Customer::find($id);

        if(is_null($customer)){
            return response()->json([
                'error' => true,
                'message'  => "Record with id # $id not found",
            ], 404);
        }

        return response()->json([
            'error' => 'success',
            'customer'  => $customer,
        ], 200);
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
        //
        $validation = Validator::make($request->all(),[ 
            'name' => 'required',
            'email' => 'required|email',
            'contact_number' => 'required',
        ]);

        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else
        {
            $customer = Customer::find($id);
            $customer->name = $request->input('name');
            $customer->email = $request->input('email');
            $customer->contact_number = $request->input('contact_number');
            $customer->save();
    
            return response()->json([
                'error' => false,
                'customer'  => $customer,
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
    }
}
