<?php

namespace App\Http\Controllers\Front\Wallets;

use App\Http\Controllers\Controller;
use App\Models\wallet;
use App\Models\walletRecipt;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WalletController extends Controller
{
    public function index()
    {
        $data['wallet_amount'] = wallet::query()->where('user_id', auth()->id())->sum('balance');

        return view('front.wallets.index', $data);
    }
    public function getIndex(Request $request)
    {
        $data = walletRecipt::query()
            ->whereHas('wallet', function ($q) {
                $q->where('user_id', auth()->id());
            });

        if ($request->filled('start_date')) {
            $data->whereDate('created_at', '>=', $request->input('start_date'));
        }
        if ($request->filled('end_date')) {
            $data->whereDate('created_at', '<=', $request->input('end_date'));
        }
        if ($request->filled('status_cd_id')) {
            $data->where('status_cd_id', $request->input('status_cd_id'));
        }

        return DataTables::of($data)
            ->addColumn('photo', function ($data) {
       return   $data->getAttachment(); // Assuming this returns a full image URL

                } )
            ->addColumn('status', function ($data) {
                return $data->getStatus();
            })
            ->rawColumns(['status', 'photo'])
            ->make(true);
    }

    public function addBalance(Request $request)
    {
        try {
            $wallet = Wallet::firstOrNew(
                ['user_id' => auth()->id()]
            );

            if (!$wallet->exists) {
                // If it doesn't exist, set initial balance and save
                $wallet->balance = 0;
                $wallet->save();
            }

            $photo = $request->file('attachment')->store('wallets', 'public');

            walletRecipt::query()->create([
                'amount' => $request->amount,
                'wallet_id' => $wallet->id,
                'status_cd_id' => 2,
                'photo' => $photo,
            ]);

            return response()->json([
                'success' => true,
                'message' => __('label.success_full_process'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('label.error_process'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
