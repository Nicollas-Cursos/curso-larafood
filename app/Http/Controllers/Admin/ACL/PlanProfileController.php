<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanProfileController extends Controller
{
    public function plans($profileId)
    {
        if (!$profile = Profile::find($profileId)) {
            return redirect()->back();
        }

        $plans = $profile->plans()->paginate();

        return view("admin.pages.profiles.plans.index", [
            "profile" => $profile,
            "plans" => $plans
        ]);
    }

    public function plansAvailable($profileId, Request $request)
    {
        if (!$profile = Profile::find($profileId)) {
            return redirect()->back();
        }

        $filters = $request->except("_token");

        $plans = $profile->plansAvailable($request->filter);

        return view("admin.pages.profiles.plans.available", [
            "profile" => $profile,
            "plans" => $plans,
            "filters" => $filters
        ]);
    }

    public function attachPlanProfile($profileId, Request $request)
    {
        if (!$request->plans) {
            return redirect()->back()->with("warning", "Marque algum plano para vincular.");
        }

        if (!$profile = Profile::find($profileId)) {
            return redirect()->back();
        }

        $profile->plans()->attach($request->plans);

        return redirect()->route("profile.plans", $profile->id);
    }

    public function detachPlanProfile($planId, $profileId)
    {
        if (!$profile = Profile::find($planId)) {
            return redirect()->back();
        }

        if (!$plan = Plan::find($profileId)) {
            return redirect()->back();
        }

        $profile->plans()->detach($plan);

        return redirect()->route("profile.plans", $profile->id);
    }
}
