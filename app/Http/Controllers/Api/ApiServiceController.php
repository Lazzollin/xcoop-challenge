<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherUser;
use Carbon\Carbon;

class ApiServiceController extends Controller
{
    /**
     * Get all vouchers bounded to user
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function user_vouchers(User $user)
    {
        $binded_vouchers = VoucherUser::where('user_id', $user->id)->get();

        if ($binded_vouchers->all() == []) {
            return response()->json([
                'message' => 'User has no vouchers'
            ], 200);
        };

        $data = array();
        $date = Carbon::now();

        for ($i = 0; $i < count($binded_vouchers->all()); $i++) {
            $voucher = Voucher::find($binded_vouchers->all()[$i]->voucher_id);
            $expiration = Carbon::createFromFormat('Y-m-d H:i:s', $voucher->expiration);

            if ($binded_vouchers[$i]->claimed_at != null) {
                $availability = 'claimed';
            } else if ($date->gt($expiration)) {
                $availability = 'expired';
            } else {
                $availability = 'available';
            }

            array_push($data, [
                'voucher' => $voucher,
                'availability' => $availability
            ]);
        }

        return response()->json([
            'message' => 'User vouchers',
            'user vouchers' => $data,
            'voucher bindings' => $binded_vouchers
        ], 200);
    }

    /**
     * Get all vouchers bounded to user
     *
     * @param  \App\Models\Voucher $voucher
     * @return \Illuminate\Http\Response
     */
    public function check_voucher(Voucher $voucher)
    {
        $date = Carbon::now();
        $expiration = $voucher->expiration;

        if ($date->gt($expiration)) {
            $availability = 'expired';
        } else {
            $availability = 'available';
        }

        return response()->json([
            'message' => 'Voucher availability check',
            'availability' => $availability
        ], 200);
    }
}
