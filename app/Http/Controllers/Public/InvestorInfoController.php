<?php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;

class InvestorInfoController extends Controller {
    public function index() { return view('public.investor-info.index'); }
}
