<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model implements TranslatableContract
{
    use Translatable;
    use HasFactory;
    protected $translatedAttributes = ['value']; // الاشياء التي سوف تترجم
    protected $table ='settings';

    // مش شرط نكتب هذه
    protected $with=['translation']; // عندما نجي نعمل سلكت بنحصل كي بهذا الاسم هذا الذي في به الاشياء المترجمه

    protected $fillable=['key','is_translatable','plain_value'];

    //  مثلا هذا الحقل موجود فيه قيم صفر وواحد ما اشتي ارجعها صفروواحد اريد ارجع صح او خطاء هذه تسماء كاستنق
    protected $casts =[
        'is_translatable' => 'boolean',

    ];

    /**
     * Set the given settings.
     *
     * @param array $settings
     * @return void
     */
    public static function setMany($settings)
    {
        foreach ($settings as $key => $value) {
            self::set($key, $value);
        }
    }

    /**
     * Set the given setting.
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
                                //  defaultlocal , ar
    public static function set($key, $value)
    {
        if ($key === 'translatable') {
            return static::setTranslatableSettings($value);
        }

        //  عملنا هذا الشرط على شان انه يقبل يدخل مصفوفه عندعمل السيدر
        if(is_array($value))
        {
            $value = json_encode($value);
        }

        static::updateOrCreate(['key' => $key], ['plain_value' => $value]);
    }

    /**
     * Set a translatable settings.
     *
     * @param array $settings
     * @return void
     */
    public static function setTranslatableSettings($settings = [])
    {
        foreach ($settings as $key => $value) {
            static::updateOrCreate(['key' => $key], [
                'is_translatable' => true,
                'value' => $value,
            ]);
        }
    }
}
