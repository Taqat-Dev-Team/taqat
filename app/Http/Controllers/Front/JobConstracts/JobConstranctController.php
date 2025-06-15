<?php

namespace App\Http\Controllers\Front\JobConstracts;

use App\Http\Controllers\Controller;
use App\Models\jobContract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobConstranctController extends Controller
{
    public function index()
    {

        return view('front.jobConstrancts.index');
    }

    public function getIndex(Request $request)
    {
        $data = jobContract::query()
            ->where('user_id', auth()->id())
            ->orderby('created_at', 'desc');

        return DataTables::of($data)
            ->addColumn('attachment', function ($data) {

                $attachments = $data->getAttachment();
                $extension = pathinfo($attachments, PATHINFO_EXTENSION);
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

            ->addColumn('action', function ($data) {


                $button = '';
                $button .= '<a  href="' . route('front.jobConstrancts.edit', $data->id) . '"   class="edit_admin"><span><i style="color: #66afe9" class="fas fa-edit"></i></span></a>';



                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button .= '<a   id="' . $data->id . '" name_delete="' . $data->company_name . '"  class="delete "><span><i  style="color: red" class="fas fa-trash-alt"></i></span></button>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                return $button;
            })->rawColumns(['action','attachment'])
            ->make(true);
    }

    public function create()
    {

        return view('front.jobConstrancts.add');
    }



    public function  store(Request $request)
    {
        try {
            $photo = "";
            if ($request->hasFile('photo')) {
                $photo =   upload($request->photo);
            }
            jobContract::query()->create([
                'company_name' => $request->company_name,
                'user_id' => auth()->id(),
                'sallary' => $request->sallary,
                'date' => Carbon::parse($request->date)->format('Y-m-d'),
                'photo' =>  url('/').'/public/files/'.$photo,
                'note' => $request->description??'',
                'job_type' => $request->job_type,
                'duration' => $request->duration,

            ]);
            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
        } catch (\Exception $ex) {
            return response_web(false, 'هناك خطا ما يرجى محاولة لاحقا', [], 500);
        }
    }

    public function edit($id)
    {

        $data['jobConstrancts'] = jobContract::query()->where('id',$id)->where('user_id',auth()->id())->first()??abort(403);;
        return view('front.jobConstrancts.edit', $data);
    }

    public function  update(Request $request)
    {
        try {
            $job_constract = jobContract::query()->findorfail($request->job_constranct_id);
            $photo = "";
            if ($request->hasFile('photo')) {
                $photo =   upload($request->photo);

                $job_constract->update([
                    'photo' =>  url('/').'/public/files/'.$photo,
                ]);
            }

            $job_constract->update([
                'company_name' => $request->company_name,
                'sallary' => $request->sallary,
                'date' => Carbon::parse($request->date)->format('Y-m-d'),
                'note' => $request->description??'',
                'duration' => $request->duration,
                'job_type' => $request->job_type,

            ]);
            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
        } catch (\Exception $ex) {
            return response_web(false, 'هناك خطا ما يرجى محاولة لاحقا', [], 500);
        }
    }
    public function delete(Request $request)
    {
        jobContract::query()->where('id', $request->id)->delete();

        return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
    }
}
