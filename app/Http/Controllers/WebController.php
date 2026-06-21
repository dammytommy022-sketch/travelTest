<?php

namespace App\Http\Controllers;

class WebController extends Controller
{
    public function aboutus()
    {
        return view('web.aboutus');
    }

    public function faq()
    {
        return view('web.faq');
    }

    public function help()
    {
        return view('web.help');
    }
}