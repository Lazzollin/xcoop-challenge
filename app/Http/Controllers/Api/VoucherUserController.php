<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VoucherUser;
use App\Models\Voucher;
use App\Models\User;
use Illuminate\Http\Request;

class VoucherUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $binded_vouchers = VoucherUser::all();

        return response()->json([
            'message' => 'Showing all voucher bindings',
            'bindings' => [$binded_vouchers]
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
        $user = User::where('id', $request->user_id)->get();
        $voucher = Voucher::where('id', $request->voucher_id)->get();

        if ($user->all() != [] and $voucher->all() != []) {
            $binded_voucher = VoucherUser::create($request->all());

            return response()->json([
                'message' => 'Created voucher binding',
                'binding' => [$binded_voucher],
                'voucher' => $voucher,
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'message' => 'User or voucher not found'
            ], 404);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoucherUser  $voucherUser
     * @return \Illuminate\Http\Response
     */
    public function show(VoucherUser $bind_voucher)
    {
        return response()->json([
            'message' => 'Showing voucher binding',
            'binding' => $bind_voucher
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VoucherUser  $voucherUser
     * @return \Illuminate\Http\Response
     */
    public function edit(VoucherUser $voucherUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VoucherUser  $voucherUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VoucherUser $bind_voucher)
    {
        $bind_voucher->update($request->all());

        return response()->json([
            'message' => 'Binding updated',
            'binding' => $bind_voucher
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoucherUser  $voucherUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoucherUser $bind_voucher)
    {
        $bind_voucher->delete();

        return response()->json([
            'message' => 'Deleted binding',
            'binding' => $bind_voucher
        ], 200);
    }
}
