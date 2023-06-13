<?php 
// namespace App\Helpers ;
use Illuminate\Support\Facades\App;

function getlocale()
{
    return App::getLocale() === 'ar' ? 'css-rtl' : 'css' ; 
}