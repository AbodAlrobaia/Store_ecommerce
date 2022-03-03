<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model implements TranslatableContract
{
    use Translatable;
    use HasFactory;
    protected $translatedAttributes = ['name']; // الاشياء التي سوف تترجم

    protected $fillable=['is_active','photo'];

    protected $hidden=['translations'];   // عندما لا نريد ان نرجع الترجمات

    //  مثلا هذا الحقل موجود فيه قيم صفر وواحد ما اشتي ارجعها صفروواحد اريد ارجع صح او خطاء هذه تسماء كاستنق

    protected $casts =[
        'is_active' => 'boolean',

    ];
    // protected $with=['translations'];  //    ممكن نكتبها في الهيدن

    public function scopeActive($query){
        return $query ->where('is_active',1) ;
    }
    public Function getActiv(){

        return $this->is_active == 1 ? 'مفعل' :' غير مفعل';
      }


    public function getPhotoAttribute($val){

        return ($val !== null) ? asset('assets/images/brands/' . $val) : "" ;

    }

}
