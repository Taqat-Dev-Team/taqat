<?php

namespace App\Http\Controllers\Companies\Mystone;

use App\Http\Controllers\Controller;
use App\Mail\PaymentUserMail;
use App\Models\CompanyProject;
use App\Models\MyStone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class MystoneController extends Controller
{
    public function index()
    {
        $mystone=MyStone::query()
        ->with('project')
        ->where('company_id', auth('company')->id());

        $data['mystone_count']=MyStone::query() ->where('company_id', auth('company')->id())->count();
        $data['mystone_amount']=MyStone::query() ->where('company_id', auth('company')->id())->sum('amount');
        $data['mystone_payment']=MyStone::query()->where('company_id', auth('company')->id())->wherestatus(2)->count();
         $data['mystone_no_payment']=MyStone::query()->where('company_id', auth('company')->id())->wherestatus(1)->sum('amount');

        return view('companies.mystones.index',$data);
    }

    public function getIndex(Request $request){

        $data = MyStone::query()
        ->with('project')
        ->where('company_id', auth('company')->id());
        return DataTables::of($data)
        ->addColumn('status', function ($data) {
            return $data->getStatus();
        })





        ->addColumn('project_title', function ($data) {
            return '<a href="'.route('companies.projects.views',$data->project_id).'">'. $data->project->title.'</a>';

        })

        ->addColumn('action',function($data){



if($data->status==1){
            return   '<a class="btn btn-primary" target="_blank" href="'.route('companies.mystone.paymentMystone',['my_stone_id'=>$data->id]).'">

           '. __('label.payment_now').'
        </a>';
}

if($data->status &&($data->widrow)){

}

        })

        ->rawColumns(['project_title', 'action','status'])
        ->make(true);



    }


    public function store(Request $request){
        $project = CompanyProject::query()->findOrFail($request->project_id);
      $mystone=  MyStone::query()->create([
            'project_id'=>$project->id,
            'order_number'=>get_order_number(),
            'user_id'=>$project->user_id,
            'company_id'=>auth('company')->id(),
            'title'=>$request->title,
            'amount'=>$request->amount,
            'date'=>Carbon::parse($request->date)->format('Y-m-d'),
            'status'=>1
        ]);

        $paymentDetails = [
            'amount' => $mystone->amount,
            'transactionId' => $mystone->order_number,
            'paymentDate' => now()->format('Y-m-d H:i:s'),
        ];

        if($project->users){
        Mail::to($project->users->email)->send(new PaymentUserMail($paymentDetails));
        }
        $response['data']=$mystone;
        return response_web(true, __('label.success_full_process'), $response, 201);

    }



    public function paymentMystone(Request $request){


        $mystone=MyStone::query()->where('id',$request->my_stone_id)->first()??abort(404);



            $order_id = $mystone->order_number; // Replace with your dynamic order ID
            $securty_codee = '3097bc-0f7124-6accca-8e58c5-aff36a'; // Replace with your API key
            $total_bill =$mystone->amount; // Replace with your total amount
            $re_url = url(app()->getLocale().'/companies/payments/verify_payment',['order_number'=>$mystone->order_number]); // Replace with your actual return URL
            $c_email ='gssan1018@gmail.com'; // Replace with customer email
            $c_mobile = $mystone->company->mobile; // Replace with customer mobile
            $c_name = $mystone->company->name; // Replace with customer name

            $inv_details = json_encode([
                "inv_items" => [
                    [
                        "name" => "Shopping from store",
                        "quntity" => "1.00",
                        "unitPrice" => $total_bill,
                        "totalPrice" => $total_bill,
                        "currency" => "USD"
                    ]
                ],
                "inv_info" => [
                    ["row_title" => "Vat", "row_value" => "0"],
                    ["row_title" => "Delivery", "row_value" => "0"],
                    ["row_title" => "Promo Code", "row_value" => 0],
                    ["row_title" => "Discounts", "row_value" => 0]
                ],
                "user" => ["userName" => "test"]
            ]);
        //createInvoiceByAccount
            $payment_url = 'https://crosspayonline.com/api/createInvoiceByAccountLahza?' . http_build_query([
                'api_data' => '82e4b4fd3a16ad99229af9911ce8e6d2',
                'invoice_id' => $order_id,
                'apiKey' => $securty_codee,
                'total' => $total_bill,
                'currency' => 'USD',
                'inv_details' => $inv_details,
                'return_url' => $re_url,
                'email' => $c_email,
                'mobile' => $c_mobile,
                'name' => $c_name
            ]);



            return redirect($payment_url);
    }

    public function verifyPayment($order_number){


        $mystone=MyStone::query()->where('order_number',$order_number)->first()??abort(404);

        $mystone->update([
            'status'=>2
        ]);

        return redirect()->route('companies.projects.views',$mystone->project_id) ;

    }
}
