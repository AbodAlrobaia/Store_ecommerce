<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TranslatableContract
{
    use Translatable;
    use HasFactory;

    protected $translatedAttributes = ['name']; // الاشياء التي سوف تترجم

    protected $fillable=['parent_id','slug','is_active'];

    protected $hidden=['translations'];   // عندما لا نريد ان نرجع الترجمات

    //  مثلا هذا الحقل موجود فيه قيم صفر وواحد ما اشتي ارجعها صفروواحد اريد ارجع صح او خطاء هذه تسماء كاستنق
    protected $casts =[
        'is_active' => 'boolean',

    ];
}
