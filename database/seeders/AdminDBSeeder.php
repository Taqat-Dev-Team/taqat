<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::query()->create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('password'),
            'is_supper'=>1,

        ]);
    }
}
