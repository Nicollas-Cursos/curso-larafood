<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilePlanController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:plans");
    }

    public function profiles($planId)
    {
        if (!$plan = Plan::find($planId)) {
            return redirect()->back();
        }

        $profiles = $plan->profiles()->paginate();

        return view("admin.pages.plans.profiles.index", [
            "plan" => $plan,
            "profiles" => $profiles
        ]);
    }

    public function profilesAvailable($planId, Request $request)
    {
        if (!$plan = Plan::find($planId)) {
            return redirect()->back();
        }

        $filters = $request->except("_token");

        $profiles = $plan->profilesAvailable($request->filter);

        return view("admin.pages.plans.profiles.available", [
            "plan" => $plan,
            "profiles" => $profiles,
            "filters" => $filters
        ]);
    }

    public function attachProfilePlan($planId, Request $request)
    {
        if (!$request->profiles) {
            return redirect()->back()->with("warning", "Marque algum perfil para vincular.");
        }

        if (!$plan = Plan::find($planId)) {
            return redirect()->back();
        }

        $plan->profiles()->attach($request->profiles);

        return redirect()->route("plan.profiles", $plan->id);
    }

    public function detachProfilePlan($planId, $profileId)
    {
        if (!$plan = Plan::find($planId)) {
            return redirect()->back();
        }

        if (!$profile = Profile::find($profileId)) {
            return redirect()->back();
        }

        $plan->profiles()->detach($profile);

        return redirect()->route("plan.profiles", $plan->id);
    }
}
