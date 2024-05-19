<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return response()->json(['customers' => $customers]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'document_number' => 'required|string|max:255|unique:customers,document_number',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'birthday' => 'required|date',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        $customer = new Customer();
        $customer->document_number = $validatedData['document_number'];
        $customer->first_name = $validatedData['first_name'];
        $customer->last_name = $validatedData['last_name'];
        $customer->address = $validatedData['address'];
        $customer->birthday = $validatedData['birthday'];
        $customer->phone_number = $validatedData['phone_number'];
        $customer->email = $validatedData['email'];
        $customer->save();

        return response()->json(['customer' => $customer], 201);
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        if (is_null($customer)) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        return response()->json(['customer' => $customer], 200);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'document_number' => 'required|string|max:255|unique:customers,document_number,' . $id,
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'birthday' => 'required|date',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        $customer = Customer::find($id);
        if (is_null($customer)) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $customer->document_number = $validatedData['document_number'];
        $customer->first_name = $validatedData['first_name'];
        $customer->last_name = $validatedData['last_name'];
        $customer->address = $validatedData['address'];
        $customer->birthday = $validatedData['birthday'];
        $customer->phone_number = $validatedData['phone_number'];
        $customer->email = $validatedData['email'];
        $customer->save();

        return response()->json(['customer' => $customer], 200);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (is_null($customer)) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $customer->delete();
        return response()->json(['message' => 'Cliente eliminado con éxito'], 200);
    }
}

