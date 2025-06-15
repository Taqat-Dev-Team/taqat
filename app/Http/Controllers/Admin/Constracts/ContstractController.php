<?php

namespace App\Http\Controllers\Admin\Constracts;

use App\Http\Controllers\Controller;
use App\Models\Contracts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContstractController extends Controller
{
    public function index()
    {
        $contracts = Contracts::query();

        $data = [
            'contracts_count' => $contracts->count(),
            'contracts_total_salary' => $contracts->sum('sallary'),
            'contracts_min_salary' => $contracts->min('sallary'),
            'contracts_max_salary' => $contracts->max('sallary'),
        ];

        return view('admin.contracts.index', $data);
    }

    public function getIndex(Request $request)
    {
        $data = Contracts::query()->orderBy('id', 'desc');

        return DataTables::of($data)
            ->addColumn('attachment', function ($data) {
                $attachments = $data->getAttachment();
                $extension = pathinfo($attachments, PATHINFO_EXTENSION);

                if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    return '<a href="' . $attachments . '" target="_blank">
                                <img src="' . $attachments . '" style="object-fit:contain;width:70px;height:70px;border-radius:50%;" class="img-thumbnail img-preview" id="imagePreview" alt="">
                            </a>';
                }

                if ($extension === 'pdf') {
                    return '<a href="' . $attachments . '" target="_blank">
                                <i class="fa fa-file-pdf" style="width:70px;height:70px;border-radius:50%;font-size:70px;color:red;"></i>
                            </a>';
                }

                return '<img src="' . asset('assets/default.png') . '" style="object-fit:contain;width:70px;height:70px;border-radius:50%;" class="img-thumbnail img-preview" id="imagePreview" alt="">';
            })
            ->addColumn('user_name', function ($data) {
                $userId = $data->user ? $data->user->id : '-';
                $userName = $data->user ? htmlspecialchars($data->user->name, ENT_QUOTES, 'UTF-8') : '-';
                return '<a href="' . route('admin.users.views', $userId) . '">' . $userName . '</a>';
            })
            ->addColumn('company_name', function ($data) {
                $company_name= $data->company ? $data->company->name : '-';
                $company_id=$data->company_id;
                return '<a href="' . route('admin.companies.edit', $company_id) . '">' . $company_name . '</a>';

            })
            ->addColumn('job_title', function ($data) {
                return $data->job ? $data->job->title : '-';
            })
            ->addColumn('specializations', function ($data) {
                return $data->specializations ? $data->specializations->title : '-';
            })
            ->addColumn('years', function ($data) {
                $startDate = Carbon::parse($data->start_date);
                $endDate = Carbon::parse($data->end_date);
                return $startDate->diffInYears($endDate);
            })

            ->rawColumns(['attachment', 'user_name','company_name'])
            ->make(true);
    }
}


