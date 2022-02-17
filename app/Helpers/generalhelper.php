<?php

use Illuminate\Support\Facades\App;


define('PAGINATION_COUNT',15);
function getfolder()
 {

    return app() -> getLocale() == 'ar' ? 'css-rtl' : 'css';

}
