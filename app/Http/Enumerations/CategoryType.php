<?php

namespace App\Http\Enumerations;

use Illuminate\Support\Env;
use Spatie\Enum\Enum;
use Psy\Command\ListCommand\Enumerator;
// use Spatie\Enum\Laravel\Enum;

final class CategoryType extends Enum
{
    const mainCategory = 1 ;
    const subCategory = 2 ;

}




