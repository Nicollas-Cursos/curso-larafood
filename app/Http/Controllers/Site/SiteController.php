<?php

namespace App\Http\Controllers\Site;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index()
    {
        $plans = Plan::with("details")->orderBy("price", "ASC")->get();

        return view("site.pages.home.index", [
            "plans" => $plans
        ]);
    }

    public function plan($planUrl)
    {
        if(!$plan = Plan::whereUrl($planUrl)->first()) {
            return redirect()->back();
        }

        session()->put("plan", $plan);

        return redirect()->route("register");
    }
}
