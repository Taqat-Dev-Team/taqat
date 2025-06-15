<?php

namespace Database\Seeders;

use App\Models\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConstantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['category' => 'account_types', 'key' => 'asset', 'value' => 'الأصول'],
            ['category' => 'account_types', 'key' => 'expense', 'value' => 'المصاريف'],
            ['category' => 'account_types', 'key' => 'revenue', 'value' => 'الإيرادات'],
            ['category' => 'account_types', 'key' => 'liability', 'value' => 'الالتزامات'],


            ['category' => 'account_types', 'key' => 'equity', 'value' => 'حقوق الملكية'],
            ['category' => 'balance_types', 'key' => 'debit', 'value' => 'مدين'],
            ['category' => 'balance_types', 'key' => 'credit', 'value' => 'دائن'],
            ['category' => 'balance_types', 'key' => 'both', 'value' => 'دائن ومدين'],
        ];


        DB::table('constants')->insert($data);


    }
}
