<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array=[

           [
               'name'=>'website_name',
               'value'=>'اسم الموقع',
               'key'=>'general',
               'input'=>'input',
               'type'=>'text',
               'status'=>1,

           ],
           [
               'name'=>'short_description',
               'value'=>'وصف مختصر للموقع وصف مختصر للموقع',
               'key'=>'general',
               'input'=>'input',
               'type'=>'text',
               'status'=>1,

           ],



           [
               'name'=>'logo_image',
               'value'=>'assets/setting/logo.jpg',
               'key'=>'general',
               'input'=>'input',
               'type'=>'file',
               'status'=>1,
           ],



           [
               'name'=>'icon_image',
               'value'=>'assets/setting/logo.icon',
               'key'=>'general',
               'input'=>'input',
               'type'=>'file',

               'status'=>1,

           ],

           [
               'name'=>'wide_image',
               'value'=>'assets/setting/logo.jpg',
               'key'=>'general',
               'input'=>'input',
               'type'=>'file',
               'status'=>1,

           ],



        ];

        foreach ($array as $value){

            Setting::query()->create([
               'name'=>$value['name'],
               'value'=>$value['value'],
               'key'=>$value['key'],
                'status'=>$value['status'],
            ]);
        }
    }
}
