<?php

namespace App\Models;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticate;

class Admin extends Authenticate
{
    use HasFactory;

    protected $table="admins";
    protected $guarded=[];//    بتجعل الاعمده كلها متاحه للادخال  مش نفس الفلابل ما بلا الذي داخلها guarded 
    // protected $fillable=['id','name','email','password','created_at','updated_at'];//   يعني الاعمده التي بنضيف فيها البfillable 
    public $timestamps=true;

}

