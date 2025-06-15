<?php

namespace App\Http\Controllers\Admin\Agreements;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Agreement\AgreementRequest;
use App\Models\Constant;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AgreementController extends Controller
{

    public function index()
    {
        logActivity('شروط الاتفاقية', auth()->user());

        return view('admin.agreements.index');
    }
    public function getIndex(Request $request)
    {


        $data = Constant::query()
            ->where('category', 'agreement')
            ->when($request->search['value'], function ($query) use ($request) {
                $query->where('value', 'like', '%' . $request->search['value'] . '%');
            })
            ->orderBy('id', 'desc');
        return DataTables::of($data)
                    ->addColumn('value', fn($data) => $data->value)

            ->addColumn('action', fn($data) => view('admin.agreements.partials.actions', compact('data')))
            ->rawColumns(['action','value'])
            ->make(true);
    }


    public function store(AgreementRequest $request)
    {
        try {

            Constant::query()->create([
                'category' => 'agreement',
                'key' => 'agreement',
                'value' => $request->value,
                'value_en' => $request->value_en,
                'is_mange' => 1,
            ]);
        logActivity('اضافة شروط الاتفاقية', auth()->user());

            return response_web(true, __('label.successful_process'), [], 201);
        } catch (\Exception $exception) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }

    public function update(AgreementRequest $request)
    {

        try {
            $agremment = Constant::query()
                ->findOrFail($request->agreement_id);
            $agremment->update([
                'value' => $request->value,
              'value_en' => $request->value_en,

            ]);

                    logActivity('تعديل شروط الاتفاقية', auth()->user());

            return response_web(true, __('label.successful_process'), [], 201);
        } catch (\Exception $exception) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }


    public function delete(Request $request)
    {

        try {
            $agremment = Constant::query()
                ->findOrFail($request->id);

            $agremment->delete();
                    logActivity('حذف شروط الاتفاقية', auth()->user());

            return response_web(true, __('label.successful_process'), [], 201);
        } catch (\Exception $exception) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }
}
