<?php 
define('PAGINATION_COUNT',10);
use Illuminate\Support\Facades\App;

function getlocale()
{
    return App::getLocale() === 'ar' ? 'css-rtl' : 'css' ; 
}