<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return json_encode(['customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'document_number' => ['required', 'unique:customers', 'max:20'],
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'address' => ['required', 'max:255'],
            'birthday' => ['required', 'date'],
            'phone_number' => ['required', 'max:15'],
            'email' => ['required', 'email', 'max:100']
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información.',
                'statusCode' => 400,
                'errors' => $validate->errors()
            ]);
        }
        $customer = Customer::find($id);
       
        $customer->document_number = $request->document_number;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->address = $request->address;
        $customer->birthday = $request->birthday;
        $customer->phone_number = $request->phone_number;
        $customer->email = $request->email;
        $customer->save();

        $customers = DB::table('customers')
        ->orderBy('id')
        ->get();
        return json_encode(['customers' => $customers]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customers = Customer::find($id);
        if(is_null( $customers))
        {
            return abort(400);
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = new Customer();
        
        $customer->document_number = $request->document_number;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->address = $request->address;
        $customer->birthday = $request->birthday;
        $customer->phone_number = $request->phone_number;
        $customer->email = $request->email;
        $customer->save();
        
        $customers = DB::table('customers')
        ->orderBy('id')
        ->get();
        return json_encode(['customers' => $customers]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        $customers = DB::table('customers')
        ->orderBy('id')
        ->get();
        return json_encode(['customers' => $customers]);
    }
}
