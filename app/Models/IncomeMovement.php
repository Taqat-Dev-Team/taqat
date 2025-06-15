<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class IncomeMovement extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeFilterByBranch($query, $admin)
    {
        // If the admin is not a super admin, filter by their branch ID
        if ($admin->branch_id) {
            $query->whereHas('user', function ($q) use ($admin) {
                $q->where('branch_id', $admin->branch_id);
            });
        }
        return $query;
    }

    public function scopeFilterByDateRange($query, $start_date, $end_date)
    {
        // Apply date range filter if both start and end dates are provided
        if ($start_date && $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        }
        return $query;
    }

    public function scopeFilterByUserType($query, $user_type)
    {
        // Apply user status filter if `user_type` is provided
        if ($user_type) {
            $query->whereHas('user', function ($q) use ($user_type) {
                $q->where('status', $user_type);
            });
        }
        return $query;
    }

    public function getAttachment()
    {



        if ($this->photo) {
            // Check if the photo URL contains 'public/files'
            if (strpos($this->photo, 'public/files') !== false) {
                return asset($this->photo);
            } else {
                // If it does not contain 'public/files', return a default URL or handle it accordingly
                return asset('public/files/' . $this->photo); // Adjust the default photo location if necessary
            }
        } else {
            return asset('assets/default.png');
        }
    }


    public function getAdjustedAmountAttribute()
    {
        $settings = Setting::query()->first()->ILS_USD ?? 3.6;
        if ($this->amount_type == 1) {
            return $this->amount;
        } elseif ($this->amount_type == 2) {
            return round($this->amount
                / $settings ?? 1, 2);
        }
        // return 0; // Default fallback
    }


    private static function getILSUSD(): float
    {
        return Cache::remember('setting_ILS_USD', 60, function () {
            return Setting::query()->first()->ILS_USD ?? 3.6;
        });
    }

    public function scopeMinAdjustedIncome($query, $userId = null)
    {
        $ilsUsd = self::getILSUSD();

        return $query->when($userId, function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
        ->selectRaw("
            MIN(
                CASE
                    WHEN amount_type = 1 THEN amount
                    WHEN amount_type = 2 THEN ROUND(amount / ?, 2)
                    ELSE 0
                END
            ) as min_income
        ", [$ilsUsd]); // Return the query builder, not the result
    }

    public function scopeMaxAdjustedIncome($query, $userId = null)
    {
        $ilsUsd = self::getILSUSD();

        return $query->when($userId, function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
        ->selectRaw("
            MAX(
                CASE
                    WHEN amount_type = 1 THEN amount
                    WHEN amount_type = 2 THEN ROUND(amount / ?, 2)
                    ELSE 0
                END
            ) as max_income
        ", [$ilsUsd]); // Return the query builder, not the result
    }

    public function scopeTotalAdjustedIncome($query, $userId = null)
    {
        $ilsUsd = self::getILSUSD();

        return $query->when($userId, function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
        ->selectRaw("
            SUM(
                CASE
                    WHEN amount_type = 1 THEN amount
                    WHEN amount_type = 2 THEN ROUND(amount / ?, 2)
                    ELSE 0
                END
            ) as amount
        ", [$ilsUsd]); // Return the query builder, not the result
    }



    /**
     * Scope to count total income movements.
     */
    public function scopeCountIncomeMovements($query, $userId = null)
    {
        return $query
            ->when($userId, function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })

            ->count();
    }
    protected function casts(): array
    {
        return [
            'amount' => 'double',
        ];
    }
}
