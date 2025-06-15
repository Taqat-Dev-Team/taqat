<?php

namespace App\Http\Controllers\Admin\Wallet;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\wallet;
use App\Models\walletRecipt;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WalletController extends Controller
{
    public function index()
    {
        $data['users'] = User::query()->where('status', 1)->get();

        return view('admin.wallets.index', $data);
    }

    public function walletRecipt()
    {
        $data['users'] = User::query()->where('status', 1)->get();

        return view('admin.walletRecipts.index', $data);
    }

    public function getIndex(Request $request)
    {
        $data = wallet::query()
            ->where('balance', '>', 0)
            ->when($request->user_id, function ($query) use ($request) {
                $query->whereHas('wallet.users', function ($q) use ($request) {
                    $q->where('id', $request->user_id);
                });
            })

            ->orderBy('id', 'desc');


        // $total_payment calculation is missing, so either remove or complete it.
        // Example: Remove the incomplete line for now.

        $total_payment = wallet::query()->sum('balance');
        $dataTable = DataTables::of($data)
            ->addColumn('photo', function ($data) {
                return '<a href="' . route('admin.users.views', $data->user_id) . '"  data-photo="' . $data->users->getPhoto() . '">'
                    . '<img src="' . $data->users->getPhoto() . '" class="circle" '
                    . 'style="object-fit:contain;width:70px;height:70px;border-radius: 50%;">'
                    . '</a>';
            })
            ->addColumn('user_name', fn($wallet) => optional($wallet->users)->name)
            ->addColumn('mobile', fn($wallet) => optional($wallet->users)->mobile)
            ->addColumn('balance', fn($wallet) => $wallet->balance)
            ->addColumn('created_at', fn($wallet) => $wallet->created_at ? $wallet->created_at->format('Y-m-d') : '')
            ->rawColumns(['photo']);

        return $dataTable->with([
            'meta' => [
                'user_count' => $data->count(),
                'total_payment' => round($total_payment),
            ]
        ])->make(true);
    }

    public function getWalletRecipt(Request $request)
    {
        $data = walletRecipt::query()
            ->when($request->user_id, function ($query) use ($request) {
                $query->whereHas('wallet.users', function ($q) use ($request) {
                    $q->where('id', $request->user_id);
                });
            })
            ->when($request->start_date, function ($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->start_date);
            })
            ->when($request->end_date, function ($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->end_date);
            })
            ->when($request->status_id, function ($query) use ($request) {
                $query->where('status_cd_id', $request->status_id);
            })
            ->orderBy('id', 'desc');


        $total_payment = walletRecipt::query()

            ->whereHas('wallet.users', function ($q) use ($request) {
                $q->where('id', $request->user_id);
            })

            ->when($request->start_date, function ($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->start_date);
            })
            ->when($request->end_date, function ($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->end_date);
            })->where('status_cd_id', 1)->sum('amount');

        $dataTable =  DataTables::of($data)
            ->addColumn('user_name', fn($data) => $data->wallet->users->name)
            ->addColumn('mobile', fn($data) => $data->wallet->users->mobile)
            ->addColumn('status', fn($data) => $data->getStatus())
            ->addColumn('date', fn($data) => $data->created_at->format('Y-m-d'))
            ->addColumn('logo', fn($data) => $data->getAttachment())
            ->addColumn('action', fn($data) => view('admin.wallets.partials.actions', compact('data')))


            ->rawColumns(['logo', 'status', 'action']);


        return $dataTable->with([
            'meta' => [
                'user_count' => 1,
                'total_payment' => round($total_payment),
            ]
        ])->make(true);
    }

    public function update(Request $request)
    {
        $walletRecipt = walletRecipt::query()->where('id', $request->wallet_id)->first();
        if (!$walletRecipt) {
            return response()->json([
                "status" => 404,
                "message" => 'لا يوجد بيانات'
            ]);
        }

        if ($request->status_cd_id == 1 && ($walletRecipt->status_cd_id != $request->status_cd_id)) {
            $wallet = wallet::firstOrNew(['user_id' => $walletRecipt->wallet->user_id]);
            if ($wallet->exists) {
                $wallet->increment('balance', $walletRecipt->amount);
            }
        }


        $walletRecipt->update([
            'status_cd_id' => $request->status_cd_id
        ]);


        return response()->json([
            "status" => 201,
            "message" => 'تمت تنفيد العملية بنجاح'
        ]);
    }

    public function delete(Request $request)
    {
        walletRecipt::query()->where('id', $request->id)->delete();

        return response()->json([
            "status" => 201,
            "message" => 'تمت عملية الحذف بنجاح'
        ]);
    }
}
