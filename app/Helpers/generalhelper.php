<?php

use Illuminate\Support\Facades\App;

function getfolder()
 {

    return app() -> getLocale() == 'ar' ? 'css-rtl' : 'css';

}
