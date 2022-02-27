<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Function_;

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

    public Function scopeParent($query){

        return $query->whereNull('parent_id',null); ;
    }

    public Function scopeChild($query){

        return $query->whereNotNull('parent_id',null); ;
    }
    public Function getActiv(){

      return $this->is_active == 1 ? 'مفعل' :' غير مفعل';
    }

    public function parents( ){
        return $this->belongsTo(self::class,'parent_id');

    }
    public function scopeActive($quere){
        return $quere -> where('is_active', 1) ;

    }
}
