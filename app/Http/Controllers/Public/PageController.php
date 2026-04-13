<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function jointVenture()
    {
        return view('public.pages.joint-venture');
    }

    public function services()
    {
        return view('public.pages.services');
    }

    public function csr()
    {
        return view('public.pages.csr');
    }
}
