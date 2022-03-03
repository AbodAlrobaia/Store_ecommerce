<?php
namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements TranslatableContract
{
    use Translatable;
        // SoftDeletes;
    use HasFactory;


    protected $translatedAttributes = ['name' ,'description','short_description']; // الاشياء التي سوف تترجم

    protected $fillable=[
        'brand_id',
        'slug',
        'sku',
        'price',
        'special_price',
        'special_price_type',
        'special_price_start',
        'special_price_end',
        'selling_price',
        'manage_stock',
        'qty',
        'in_stock',
        'viewed',
        'is_active',



        ];

    protected $hidden=['translations'];   // عندما لا نريد ان نرجع الترجمات

    //  مثلا هذا الحقل موجود فيه قيم صفر وواحد ما اشتي ارجعها صفروواحد اريد ارجع صح او خطاء هذه تسماء كاستنق
    protected $casts =[
        'is_active' => 'boolean',
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',

    ];

    protected $dates = [
        'special_price_start',
        'special_price_end',
        'start_date',
        'end_date',
        'deleted_at'
    ];

    public function brand(){
        return $this->belongsTo(Brand::class)->withDefault(); //  على اساس اذا رجعت بنل  withDefault  فعلنا
    }

    public function categories(){

        return $this->belongsToMany(Category::class,'product_categories');
    }

    public function tags(){

        return $this->belongsToMany(Tag::class.'product_tags');
    }
}
