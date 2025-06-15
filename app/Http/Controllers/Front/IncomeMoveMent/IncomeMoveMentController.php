<?php

namespace App\Http\Controllers\Front\IncomeMoveMent;

use App\Http\Controllers\Controller;
use App\Models\IncomeMovement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IncomeMoveMentController extends Controller
{
    public function index()
    {

        $userId = auth()->id();

        $incomeMovement=IncomeMovement::query()->where('user_id',$userId)->count();
        $data['count_income'] = $incomeMovement?IncomeMovement::countIncomeMovements($userId):0;
        $data['min_income'] = $incomeMovement?IncomeMovement::minAdjustedIncome($userId)->value('amount'):0;
        $data['max_income'] = $incomeMovement?IncomeMovement::maxAdjustedIncome($userId)->value('amount'):0;
        $data['total_income'] = $incomeMovement?IncomeMovement::totalAdjustedIncome($userId)->value('amount'):0;

        return view('front.incomeMovements.index', $data);
    }

    public function getIndex(Request $request)
    {
        $data = IncomeMovement::query()

            ->where('user_id', auth()->id())
            ->orderby('created_at', 'desc');

        return DataTables::of($data)
            ->addColumn('attachment', function ($data) {

                $attachments = $data->getAttachment();
                $extension = pathinfo($attachments, PATHINFO_EXTENSION);

                // dd($extension);
                $attachment = '';
                if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    $attachment .= '<a href="' . $attachments . '" target="_blank"><img src="' . $attachments . '" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;" class="img-thumbnail img-preview" id="imagePreview" alt=""></a>';
                } else if (in_array($extension, ['pdf'])) {
                    $attachment .= '<a href="' . $attachments . '" target="_blank">
                <i class="fa fa-file-pdf" style="width:70px;height:70px;border-radius: 50%;font-size: 70px; color: red;"></i>
            </a>';
                } else {

                    $attachment .= '<img src="' . asset('assets/default.png') . '" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;" class="img-thumbnail img-preview" id="imagePreview" alt="">';
                }
                return $attachment;
            })

            ->addColumn('amount', function ($data) {
return $data->adjusted_amount;
            })
            ->addColumn('action', function ($data) {


                $button = '';
                $button .= '<a  href="' . route('front.incomeMovements.edit', $data->id) . '"   class="edit_admin"><span><i style="color: #66afe9" class="fas fa-edit"></i></span></a>';



                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button .= '<a   id="' . $data->id . '" name_delete="' . $data->source . '"  class="delete "><span><i  style="color: red" class="fas fa-trash-alt"></i></span></button>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                return $button;
            })->rawColumns(['action', 'attachment'])
            ->make(true);
    }

    public function create()
    {

        return view('front.incomeMovements.add');
    }



    public function  store(Request $request)
    {
        try {
            $photo = "";
            if ($request->hasFile('photo')) {
                $photo =   upload($request->photo);
            }
            IncomeMovement::query()->create([
                'amount' => $request->amount,
                'user_id' => auth()->id(),
                'source' => $request->source,
                'date' => Carbon::parse($request->date)->format('Y-m-d'),
                'photo' => $photo,
                'note' => $request->description ?? '',
                'amount_type' => $request->amout_type,

            ]);
            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
        } catch (\Exception $ex) {
            return response_web(false, 'هناك خطا ما يرجى محاولة لاحقا', [], 500);
        }
    }

    public function edit($id)
    {

        $data['incomeMovement'] = IncomeMovement::query()->where('id', $id)->where('user_id', auth()->id())->first() ?? abort(403);
        return view('front.incomeMovements.edit', $data);
    }

    public function  update(Request $request)
    {
        try {
            $income_movement = IncomeMovement::query()->findorfail($request->income_movement_id);
            $photo = "";
            if ($request->hasFile('photo')) {
                $photo =   upload($request->photo);

                $income_movement->update([
                    'photo' => $photo,
                ]);
            }

            $income_movement->update([
                'amount' => $request->amount,
                'user_id' => auth()->id(),
                'source' => $request->source,
                'date' => Carbon::parse($request->date)->format('Y-m-d'),
                'note' => $request->description ?? '',
                'amount_type' => $request->amout_type,


            ]);
            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
        } catch (\Exception $ex) {

            return response_web(false, 'هناك خطا ما يرجى محاولة لاحقا', [], 500);
        }
    }
    public function delete(Request $request)
    {
        //        dd($request);
        IncomeMovement::query()->where('id', $request->id)->delete();
        return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
    }
}
