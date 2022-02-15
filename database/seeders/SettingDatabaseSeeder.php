<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // Setting::create([
        //     'key' =>'my name',
        //     'is_translatable'=>0,
        //     'plain_value' => 'abod'

        // ]);
        Setting::setMany([
            'default_locale' => 'ar',//الغة الافتراضية
            'default_timezone' => 'Africa/Cairo',//
            'reviews_enabled' => true,// السماح بتعليقات
            'auto_approve_reviews' => true,// نوافق على التليقات بشكل تومتيكي
            'supported_currencies' => ['USD','LE','SAR','Yr'],// العملات المدعومة
            'default_currency' => 'USD',// العملة الافتراضية
            'store_email' => 'admin@ecommerce.test',// الايميل تبع المتجر
            'search_engine' => 'mysql',// نعمل بحث على قاعدة الببانات تبعنا
            'local_shipping_cost' => 0,//التوصيل الداخلي
            'outer_shipping_cost' => 0,// التوصي الخارجي
            'free_shipping_cost' => 0,// التوصيل المجاني
            'translatable' => [
                'store_name' => 'متجر الامامي',
                'free_shipping_label' => 'توصيل مجاني',
                'local_label' => 'توصيل داخلي',
                'outer_label' => 'توصيل خارجي',
            ],

        ]);
    }
}
