<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagTranslation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps =false ;  // فعلها فلس لان احنا مش حاطين تايم استام في الجدول
}
