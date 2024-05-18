<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Paymode;
use Illuminate\Http\Request;

class PaymodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymodes = Paymode::all();
        $paymodes =DB::table('paymode')->get();
        return json_encode( ['paymodes' => $paymodes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'max:50', 'unique:paymodes,name,' . $id],
            'observation' => ['required', 'max:2000']
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información.',
                'statusCode' => 400
            ]);
        }
        $paymode = new Paymode();

        $paymode->Name = $request->Name;
        $paymode->Observation = $request->Observation;

        $paymode->save();

        $paymodes = DB::table('paymode')
            ->orderBy('id')
            ->get();

            return json_encode( ['paymodes' => $paymodes]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paymodes = Paymode::find($id);
        if(is_null($paymodes))
        {
            return abort(400);
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'max:50', 'unique:paymodes,name,' . $id],
            'observation' => ['required', 'max:2000']
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información.',
                'statusCode' => 400
            ]);
        }
        $paymode = Paymode::find($id);

        $paymode->Name = $request->Name;
        $paymode->Observation = $request->Observation;

        $paymode->save();

        $paymodes = DB::table('paymode')
            ->orderBy('id')
            ->get();

            return json_encode( ['paymodes' => $paymodes]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paymode = Paymode::find($id);
        $paymode->delete();

        $paymodes = DB::table('paymode')
            ->orderBy('id')
            ->get();

            return json_encode( ['paymodes' => $paymodes]);
    }
}
