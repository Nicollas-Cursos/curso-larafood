<?php

namespace App\Http\Controllers\Site;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index()
    {
        $plans = Plan::all();

        return view('site.pages.home.index', [
            'plans' => $plans
        ]);
    }
}
