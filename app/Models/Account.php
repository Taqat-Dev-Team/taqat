<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{

    protected $guarded = [];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'parent_id', 'id');
    }

    /**
     * علاقة الأبناء المباشرة
     */
    public function children(): HasMany
    {
        return $this->hasMany(Account::class, 'parent_id', 'id');
    }

    /**
     * علاقة تحميل الأبناء بشكل تكراري (Recursive)
     *
     * تـستخدم لتحميل جميع مستويات الأبناء (متداخلة).
     */
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive', 'formTransactions', 'toTransactions');
    }

    /**
     * معاملات الحساب التي يكون هذا الحساب هو المصدر (form_account_id)
     */
    public function formTransactions()
    {
        return $this->hasMany(Transaction::class, 'form_account_id', 'id');
    }

    /**
     * معاملات الحساب التي يكون هذا الحساب هو المستقبل (to_account_id)
     */
    public function toTransactions()
    {
        return $this->hasMany(Transaction::class, 'to_account_id', 'id');
    }

    /**
     * حساب إجمالي المدين (balance_type_id = 6) مع جمع قيم الأبناء بشكل تكراري.
     *
     * @return float
     */
    public function getTotalDebitAttribute(): float
    {
        // تأكد من تحميل علاقة الأبناء إذا لم تكن محملة
        $this->loadMissing('children');
        return $this->calculateRecursiveDebit($this);
    }

    /**
     * حساب إجمالي الدائن (balance_type_id = 7) مع جمع قيم الأبناء بشكل تكراري.
     *
     * @return float
     */
    public function getTotalCreditAttribute(): float
    {
        // تأكد من تحميل علاقة الأبناء إذا لم تكن محملة
        $this->loadMissing('children');
        return $this->calculateRecursiveCredit($this);
    }

    /**
     * حساب الصافي (دائن - مدين)
     *
     * @return float
     */
    public function getNetBalanceAttribute(): float
    {
        return $this->total_credit - $this->total_debit;
    }

    /**
     * دالة مساعدة لحساب قيمة المدين بشكل تكراري لجميع مستويات الأبناء.
     *
     * @param Account $account
     * @return float
     */

     public function balanceTypes(){
        return $this->belongsTo(Constant::class,'balance_type_id','id');
     }
    protected function calculateRecursiveDebit($account): float
    {
        $total = 0.0;

        // اجمع معاملات toTransactions أيضًا بنفس الشرط إن كان مطلوبًا في منطقك
        // يمكنك إلغاء هذا القسم إذا كان منطق المدين لا يشمل toTransactions
        $total += $account->toTransactions()
            // ->where('balance_type_id', 6)
            ->sum('amount');

        // اجمع قيم أبناء الحساب بشكل تكراري
        foreach ($account->children as $child) {
            // تأكد من تحميل علاقة الأبناء للعقدة الفرعية لتفادي Lazy Loading المتكرر
            $child->loadMissing('children');
            $total += $this->calculateRecursiveDebit($child);
        }

        return $total;
    }

    /**
     * دالة مساعدة لحساب قيمة الدائن بشكل تكراري لجميع مستويات الأبناء.
     *
     * @param Account $account
     * @return float
     */
    protected function calculateRecursiveCredit($account): float
    {
        // مجموع معاملات الحساب نفسه (من toTransactions حيث balance_type_id = 7)

        $total=0.0;

        // اجمع معاملات formTransactions أيضًا بنفس الشرط إن كان منطق الدائن يشملها
        // يمكنك إلغاء هذا القسم إذا لم يكن مطلوباً
        $total += $account->formTransactions()
            // ->where('balance_type_id', 7)
            ->sum('amount');

        // اجمع قيم أبناء الحساب بشكل تكراري
        foreach ($account->children as $child) {
            $child->loadMissing('children');
            $total += $this->calculateRecursiveCredit($child);
        }

        return $total;
    }

    /**
     * Scope لتحميل الأبناء بشكل تكراري مع المعاملات
     *
     * مثال على استخدامه: Account::withRecursiveChildren()->find($id);
     */
    public function scopeWithRecursiveChildren($query)
    {
        return $query->with([
            'childrenRecursive',
            'formTransactions',
            'toTransactions'
        ]);
    }
}
