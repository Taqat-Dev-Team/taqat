<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            // جلب أنواع الحسابات من الجدول constants
            $assets = Constant::where('category', 'account_types')->where('key', 'asset')->first();
            $expenses = Constant::where('category', 'account_types')->where('key', 'expense')->first();
            $revenues = Constant::where('category', 'account_types')->where('key', 'revenue')->first();
            $equity = Constant::where('category', 'account_types')->where('key', 'equity')->first();
            $liability = Constant::where('category', 'account_types')->where('key', 'liability')->first();


            $debit = Constant::where('category', 'balance_types')->where('key', 'debit')->first();
            $credit = Constant::where('category', 'balance_types')->where('key', 'credit')->first();
            $both = Constant::where('category', 'balance_types')->where('key', 'both')->first();



            // إضافة حسابات للمصفوفة
            Account::insert([
                ['name' => ' الأصول', 'code' => '1000', 'parent_id' => null, 'type_id' => $assets->id, 'balance_type_id' => $both->id],
                ['name' => 'الالتزامات', 'code' => '2000', 'parent_id' => null, 'type_id' => $liability->id, 'balance_type_id' => $both->id],
                ['name' => 'حقوق الملكية', 'code' => '3000', 'parent_id' => null, 'type_id' => $equity->id, 'balance_type_id' => $both->id],
                ['name' => 'الإيرادات', 'code' => '4000', 'parent_id' => null, 'type_id' => $revenues->id, 'balance_type_id' => $both->id],
                ['name' => 'المصاريف', 'code' => '2000', 'parent_id' => null, 'type_id' => $expenses->id, 'balance_type_id' => $both->id],

            ]);
        }
    }

