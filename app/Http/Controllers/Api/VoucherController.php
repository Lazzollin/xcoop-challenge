<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::all();

        return response()->json([
            'message' => 'Showing all vouchers',
            'vouchers' => [$vouchers]
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $voucher = Voucher::create($request->all());

        return response()->json([
            'message' => 'Voucher created',
            'voucher' => $voucher
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
        return response()->json([
            'message' => 'Showing voucher',
            'voucher' => $voucher
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voucher $voucher)
    {
        $voucher->update($request->all());

        return response()->json([
            'message' => 'Voucher updated',
            'voucher' => $voucher
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();

        return response()->json([
            'message' => 'Voucher deleted',
            'voucher' => $voucher
        ]);
    }
}
