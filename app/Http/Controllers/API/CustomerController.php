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
        try {
        // Validate the value...
           $customers =  DB::table('customer')->get();
            return response()->json([
                'message' => 'success',
                 'customers'  => $customers,
            ], 200);    
        } catch (Exception $e) {
            report($e);
           return response()->json([
                'status' => 'error',
                'message' => $e,
                 'customers'  => $customers,
            ], 404);   
        }
     
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
            'email' => 'required|email|unique:customer,email',
            'contact_number' => 'required',
        ]);
        try {
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
                'messages'  => "successfully created an customers",
                'customer'  => $customer,
            ], 200);
        }
        } catch (Exception $e) {
              return response()->json([
                'status' => 'error',
                'messages'  => "failed to create customers.",
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
        try {
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else
        {
            DB::table('customer')
            ->where('id', $id)
            ->update ([
                'name' => $request["name"],
                'email' => $request["email"],
                'contact_number' => $request["contact_number"]
            ]);
            return response()->json([
                'error' => false,
                'messages'  => "successfully updating customers.",
            ], 200);
        }
        } catch (Exception $e) {
                  return response()->json([
                    'status' => 'error',
                    'messages'  => "failed to update customers.",
                ], 404);
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
        try {
            //
            $customer = \App\Customer::find($id);
            if($customer!=null) {
                $customer->delete();
                return response()->json([
                    'error' => false,
                    'messages'  => "successfully deleting customers with id.". $id,
                ], 200);
            }
        } catch (Exception $e) {
             return response()->json([
                    'status' => 'error',
                    'messages'  => "failed deleting customers.",
            ], 404);
        }
    }
}
