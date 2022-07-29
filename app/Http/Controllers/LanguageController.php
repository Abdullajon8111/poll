<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLang($langcode)
    {
        app()->setLocale($langcode);
        session(['lang_code' => $langcode]);

        return redirect()->back();
    }
}
