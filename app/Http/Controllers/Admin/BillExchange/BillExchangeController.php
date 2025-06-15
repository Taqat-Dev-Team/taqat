<?php

namespace App\Http\Controllers\Admin\BillExchange;

use App\Http\Controllers\Controller;
use App\Models\BillExchange;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Mpdf\Mpdf;

class BillExchangeController extends Controller
{

    public function index()
    {

        return view('admin.billExchanges.index');
    }

    public function getIndex(Request $request)
    {
        $serach = $request->search['value'] ?? false;
        $data = BillExchange::query()

        ->when(request('start_date'), function ($query) {
            // Parse the start_date to a Carbon instance to ensure proper format
            $startDate = Carbon::parse(request('start_date'))->startOfDay();
            $query->where('date', '>=', $startDate);
        })
        // Apply end_date filter if it exists
        ->when(request('end_date'), function ($query) {
            // Parse the end_date to a Carbon instance and set it to the end of the day to include all records up to that date
            $endDate = Carbon::parse(request('end_date'))->endOfDay();
            $query->where('date', '<=', $endDate);
        })
                    ->when($serach, function ($q) use ($serach) {
                $q->where('name', 'like', '%' . $serach . '%');
            })->orderby('id', 'desc');

        return DataTables::of($data)



            ->addColumn('action', function ($data) {

                $button = '';
                // if(auth('admin')->user()->can('create_branch')) {
                    $button .= '<a href="'.route('admin.billExchages.pdf',$data->id).'" data-bill_exchange_id="' . $data->id . '"
                    data-name="' . $data->name . '"
                    data-id_number="' . $data->id_number . '"
                    data-mobile="' . $data->mobile . '"
                    data-amount="' . $data->amount . '"
                    data-amount_letter="' . $data->amount_letter . '"
                    data-date="' . $data->date . '"
                    data-payment_method="' . $data->payment_method . '"
                    data-cheque_number="' . $data->cheque_number . '"
                    data-bank_name="' . $data->bank_name . '"
                    data-other_method="' . $data->other_method . '"
                    >
                    <span><i style="color: green" class="fa fa-print"></i></span>
                </a>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                // if(auth('admin')->user()->can('create_branch')) {
                    $button .= '<a data-bill_exchange_id="' . $data->id . '"
                    data-name="' . $data->name . '"
                    data-id_number="' . $data->id_number . '"
                    data-mobile="' . $data->mobile . '"
                    data-amount="' . $data->amount . '"
                    data-amount_letter="' . $data->amount_letter . '"
                    data-date="' . $data->date . '"
                    data-payment_method="' . $data->payment_method . '"
                    data-cheque_number="' . $data->cheque_number . '"
                    data-bank_name="' . $data->bank_name . '"
                    data-other_method="' . $data->other_method . '"
                    class="edit_bill_exchange">
                    <span><i style="color: #66afe9" class="fa fa-edit"></i></span>
                </a>';                // }
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                // if(auth('admin')->user()->can('delete_branch')) {
                $button .= '<a href="" id="' . $data->id . '" name_delete="' . $data->name . '" class="delete"><span><i style="color: red" class="fa fa-trash"></i></span></a>';
                // }
                return $button;
            })->rawColumns(['action', 'status', 'branch_name'])
            ->make(true);
    }

    public function store(Request $request)
    {

        try {



            // dd($request->payment_method);
            $billExchange = BillExchange::create([
                'id_number' => $request->id_number,
                'name' => $request->name,
                'mobile' => $request->mobile,
                'date' => $request->date,
                'amount' => $request->amount,
                'amount_letter' => $request->amount_letter,
                'cheque_number'=>$request->cheque_number,
                'payment_method'=>$request->payment_method,
                'other_method'=>$request->other_method,
                'bank_name'=>$request->other_method,

            ]);

            return response_web(true, __('label.successful_process'), [], 201);
        } catch (\Exception $exception) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }


    public function update(Request $request)
    {

        try {


            $billExchange = BillExchange::query()->find($request->bill_exchange_id);
            $billExchange->update([
                'id_number' => $request->id_number,
                'name' => $request->name,
                'mobile' => $request->mobile,
                'date' => $request->date,
                'amount' => $request->amount,
                'amount_letter' => $request->amount_letter,
                'cheque_number'=>$request->cheque_number,
                'payment_method'=>$request->payment_method,
                'other_method'=>$request->other_method,
                'bank_name'=>$request->other_method,
            ]);

            return response_web(true, __('label.successful_process'), [], 201);
        } catch (\Exception $exception) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }
    public function delete(Request $request)
    {
        try {

            BillExchange::query()->where('id', $request->id)->delete();
            return response_web(true, __('label.successful_process'), [], 201);
        } catch (\Exception $exception) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }


    public function print(Request $request)
    {
        try {
            // Fetch the first BillExchange record or handle if it's missing
            $billExchange = BillExchange::first();

            // If no BillExchange record exists, return an appropriate response
            if (!$billExchange) {
                return response_web(false, __('label.bill_exchange_not_found'), [], 404);
            }

            // Render the HTML content for the PDF
            $html = view('pdf.billExchange', compact('billExchange'))->render();

            $mpdf = new Mpdf([
                'default_font' => 'cairo', // Set Cairo as the default font
                'fontDir' => array_merge((new \Mpdf\Config\ConfigVariables())->getDefaults()['fontDir'], [
                    public_path('fonts'), // Add your custom fonts directory
                ]),
                'fontdata' => array_merge((new \Mpdf\Config\FontVariables())->getDefaults()['fontdata'], [
                    'cairo' => [
                        'R' => 'Cairo-Regular.ttf', // Regular font file for Cairo
                        'B' => 'Cairo-Bold.ttf',    // Bold font file for Cairo (if available)
                    ],
                ]),
            ]);
            // $mpdf = new \Mpdf\Mpdf(['default_font' => 'dejavusans']);
            $mpdf->WriteHTML($html);
            return $mpdf->Output('receipt.pdf', 'I');


        } catch (\Exception $exception) {
            // Log the exception for debugging
            Log::error('Error generating PDF: ' . $exception->getMessage());

            // Return a generic error response
            return response_web(false, __('label.error_server'), [], 500);
        }
    }


    }




