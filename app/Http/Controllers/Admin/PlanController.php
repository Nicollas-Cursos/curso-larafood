<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::latest()->paginate();

        return view("admin.pages.plans.index", [
            "plans" => $plans
        ]);
    }

    public function create()
    {
        return view("admin.pages.plans.create");
    }
    
    public function store(StoreUpdatePlan $request)
    {
        Plan::create($request->all());

        return redirect()->route("plans.index");
    }

    public function show($url)
    {
        if(!$plan = Plan::whereUrl($url)->first()) {
            return redirect()->back();
        }

        return view("admin.pages.plans.show", [
            "plan" => $plan
        ]);
    }

    public function edit($url)
    {
        if(!$plan = Plan::whereUrl($url)->first()) {
            return redirect()->back();
        }

        return view("admin.pages.plans.edit", [
            "plan" => $plan
        ]);
    }

    public function update($url, StoreUpdatePlan $request)
    {
        if(!$plan = Plan::whereUrl($url)->first()) {
            return redirect()->back();
        }

        $plan->update($request->all());

        return redirect()->route("plans.index");
    }

    public function destroy($url)
    {
        if(!$plan = Plan::whereUrl($url)->first()) {
            return redirect()->back();
        }

        $plan->delete();

        return redirect()->route("plans.index");
    }

    public function search(Request $request)
    {
        $filters = $request->except("_token");
        $filteredPlans = Plan::search($request->filter);

        return view("admin.pages.plans.index", [
            "plans" => $filteredPlans,
            "filters" => $filters
        ]);
    }
}
