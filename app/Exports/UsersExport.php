<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $status;
    protected $company_id;
    protected $displacement_place;
    protected $branch_id;
    protected $permanent_type;

    // Constructor to accept parameters from the controller
    public function __construct($status, $company_id, $displacement_place, $branch_id, $permanent_type)
    {
        $this->status = $status;
        $this->company_id = $company_id;
        $this->displacement_place = $displacement_place;
        $this->branch_id = $branch_id;
        $this->permanent_type = $permanent_type;
    }

    public function collection()
    {
        $userQuery = User::query();

        $displacement_place = json_decode(str_replace("'", '"', $this->displacement_place), true);

        // Apply filters using class properties
        $userQuery->when($this->company_id, fn($q) => $q->where('company_id', $this->company_id))
            ->when($this->permanent_type, fn($q) => $q->where('permanent_type', $this->permanent_type))
            ->when($this->branch_id, fn($q) => $q->where('branch_id', $this->branch_id))
            ->when($this->displacement_place, fn($q) => $q->whereIn('displacement_place', $displacement_place));

//        dd($this->displacement_placeplace);
        // Apply status-specific filters
        $userQuery->when($this->status, function ($q) {
            $admin = auth('admin')->user(); // Assuming the admin is the authenticated user


            switch ($this->status) {
                case 'non-hub':
                    $q->where('status', 3);
                    break;
                case 'non-active':
                    $q->where('status', 0)
                        ->when($admin->branch_id, fn($q) => $q->where('branch_id', $admin->branch_id));
                    break;
                case 'complete-profile':
                    $q->whereHas('projects')
                        ->whereNotNull('bio')
                        ->whereNotNull('skills');
                    break;
                case 'inside-hub':
                    $q->where('status', 1)
                        ->when($admin->branch_id, fn($q) => $q->where('branch_id', $admin->branch_id));
                    break;
            }
        });



        // Execute and return the query result
        return $userQuery->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Mobile',
            'Specatioaztion',
            'WhatsApp',
            'branch',
            'Work Attachment',
            'Total hours Work',
        ];
    }

    public function map($user): array
    {
        // Check if user has jobContracts and access the first one
        $jobContracts = $user->jobContracts;

        $firstAttachment = $jobContracts && $jobContracts->isNotEmpty()
            ? ($jobContracts->first()->photo ? $jobContracts->first()->getAttachment() : 'N/A')
            : 'N/A';

        return [
            $user->id,
            $user->name,
            $user->email,
            $user->mobile,
            $user->specialization?->title,
            $user->whatsapp,
            $user->branch?->name,
            $user->attendanceTotalHourse(),
            $firstAttachment,
        ];
    }
}




