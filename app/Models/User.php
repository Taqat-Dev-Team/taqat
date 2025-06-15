<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Translatable\HasTranslations;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded=[];

    use SoftDeletes;


    public function orders(){

        return $this->hasMany(Order::class,'user_id','id');
    }

    public function wallet(){
        return $this->hasOne(wallet::class,'user_id','id');
    }

    public static function clientID()
    {
        return 'zoom_client_of_user';
    }

    public static function clientSecret()
    {
        return 'zoom_client_secret_of_user';
    }

    public static function accountID()
    {
        return 'zoom_account_id_of_user';
    }




    public function subscriptionInternets()
    {
        return $this->hasMany(SubscriptionInternet::class,'user_id','id');
    }



    public function userLogWhatsappClicks()
    {
        return $this->hasMany(UserLogWhatsappClick::class,'user_id','id');
    }
    public function getPhoto(){


        if ($this->photo) {
            // Check if the photo URL contains 'public/files'
            if (strpos($this->photo, 'public/files') !== false) {
                return asset($this->photo);
            } else {
                // If it does not contain 'public/files', return a default URL or handle it accordingly
                return $this->photo; // Adjust the default photo location if necessary
            }
        } else {
            return asset('assets/default.png');
        }

    }

      public function getIdPhoto(){


        if ($this->id_photo) {
            // Check if the photo URL contains 'public/files'
                return asset('public/storage/'.$this->id_photo);

        } else {
            return asset('assets/default.png');
        }

    }




    public function userRooms(){
        return $this->hasMany(UserRoom::class,'user_id','id')->wherehas('rooms');
    }


    public function rooms(){
        return $this->hasMany(Room::class,'user_id','id');

    }

    public function deskMangment()
    {
        return $this->hasOne(DeskMangment::class,'user_id','id');
    }


    public function attendancesWithinDateRange($startDate=null, $endDate=null)
    {
        return $this->hasMany(Attendance::class)
            ->when($startDate&&$endDate,function ($q)use($startDate,$endDate){
                $q            ->whereBetween('date', [$startDate, $endDate]);

            });
    }

    public function attendanceTotalHourse()
    {
        $attendance_hours = Attendance::query()->where('user_id', $this->id)->sum('hours');
        $log_hours = Log::query()->where('user_id', $this->id)->sum('duration') / 60;
        return number_format($attendance_hours + $log_hours,2);




    }

    public function attendanceTotalHoursCurrentMonthly()
    {
        // Calculate and get the total hours worked by the user in the current month


        $attendance_hours = $this->attendances()
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('hours');

        $log_hours = $this->logs()
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('duration') / 60;

        return number_format($attendance_hours + $log_hours, 2);
    }


    public function incomeMovements(){
        return   $this->hasMany(IncomeMovement::class,'user_id','id');
    }


    public function logs(){
        return   $this->hasMany(Log::class,'user_id','id');
    }
    public function invoices(){
        return   $this->hasMany(Invoice::class,'user_id','id');
    }


    public function jobContracts(){
        return   $this->hasMany(jobContract::class,'user_id','id');
    }


    public function totalIncome(){
        return   $this->incomeMovements()->sum('amount');
    }

    public function IncomeCount(){
        return   $this->incomeMovements()->count();
    }
    public function countProjects(){
        return   $this->projects()->count();
    }


    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id','id');
    }


    public function minIncome(){
        return   $this->incomeMovements()->min('amount')??0;
    }
    public function maxIncome(){
        return   $this->incomeMovements()->max('amount')??0;
    }




    public function totalInvoiceNotPaid(){
        $skekel_amount = $this->invoices()->where('amount_type', 2)->where('status', 0)->sum('amount');
        $dollar_amount = $this->invoices()->where('amount_type', 1)->where('status', 0)->sum('amount');

        // Check if user has any related userRooms or rooms
        $hasRooms = $this->userRooms()->exists() || $this->rooms()->exists();

        if ($hasRooms) {
            // Get user_ids from userRooms and rooms
            // Get user_ids of room managers via the userRooms relationship
            $userRoomUserIds = $this->userRooms()->with('rooms')->wherehas('rooms')->get()->pluck('rooms.user_id')->filter()->unique()->toArray();
            $roomUserIds = $this->rooms()->pluck('user_id')->toArray();
            $allUserIds = array_unique(array_merge([$this->id], $userRoomUserIds, $roomUserIds));

            // Sum invoices for all related user_ids
            $skekel_amount = \App\Models\Invoice::whereIn('user_id', $allUserIds)
                ->where('amount_type', 2)
                ->where('status', 0)
                ->sum('amount');
            $dollar_amount = \App\Models\Invoice::whereIn('user_id', $allUserIds)
                ->where('amount_type', 1)
                ->where('status', 0)
                ->sum('amount');
                // dd('asas');
        }

        $result = $dollar_amount . ' $ + ' . $skekel_amount . ' ₪';

        // Highlight if user has rooms
        if ($hasRooms) {
            $result = '<span style="background: #fffbe6; color: #d35400; ">' . $result . '</span>';
        }

        return $result;
    }
    public function contracts(){
        return $this->hasMany(Contracts::class,'user_id','id');
    }

    public function courses(){
        return $this->hasMany(TrainingCourse::class,'user_id','id');
    }
    public function attachments(){
        return $this->hasMany(Attachment::class,'user_id','id');
    }


    public function projects(){
        return $this->hasMany(Project::class,'user_id','id');
    }

    public function scientificCertificate(){
        return $this->hasMany(ScientificCertificate::class,'user_id','id');
    }

    public function workExperiences(){
        return $this->hasMany(WorkExperience::class,'user_id','id');
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class,'user_id','id');
    }

    public function companies(){
        return $this->belongsTo(Company::class,'company_id','id');
    }
        public function specialization()
    {
        return $this->belongsTo(Specialization::class,'specialization_id','id')->withDefault('أخرى');
    }

    public function rattings(){
        $html='<div class="star-rating">';
        for ($i = 1; $i <= 5; $i++){
            if ($i <= $this->rate){
               $html.='<i class="fas fa-star" style="color:coral;"></i>';
            }else{
               $html.='<i class="far fa-star"></i>';
            }
        }
        $html.='</div>';

        return $html;

    }

    public function chats(){
        return $this->hasMany(Chat::class,'user_id','id');
    }


    public function userTypes(){
        return $this->belongsTo(Constant::class,'user_type_cd_id','id');
    }
    public function totalContracts(){
        return $this->jobContracts()->sum('sallary');
    }


    public function permanentType()
    {
        $types = [
            1 => __('label.company_employee'),
            2 => __('label.freelancer'),
            3 => __('label.student'),
        ];

        return $this->permanent_type && isset($types[$this->permanent_type])
            ? $types[$this->permanent_type]
            : null;
    }

}


