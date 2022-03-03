<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model implements TranslatableContract
{
    use Translatable;
    use HasFactory;

    protected $with=['translation'];
    protected $translatedAttributes=['name'];

    protected $fillable =['slug'];

    public $timestamps =false ;

    public function scopeActive($quere){
        return $quere ->where('is_active',1) ;
        // return $query ->where('is_active',1) ;
    }
}
