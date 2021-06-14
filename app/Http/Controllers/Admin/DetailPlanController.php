<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Models\DetailPlan;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailPlan;

class DetailPlanController extends Controller
{
    public function index($planUrl)
    {
        if(!$plan = Plan::whereUrl($planUrl)->first()) {
            return redirect()->back();
        }

        $details = $plan->details()->latest()->paginate();

        return view('admin.pages.plans.details.index', [
            'plan' => $plan,
            'details' => $details
        ]);
    }

    public function show($planUrl, $idDetail)
    {
        $plan = Plan::whereUrl($planUrl)->first();
        $detail = DetailPlan::find($idDetail);

        if(!$plan || !$detail) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.show', [
            'plan' => $plan,
            'detail' => $detail
        ]);
    }

    public function create($planUrl)
    {
        if(!$plan = Plan::whereUrl($planUrl)->first()) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.create', [
            'plan' => $plan
        ]);
    }

    public function store($planUrl, StoreUpdateDetailPlan $request)
    {
        if(!$plan = Plan::whereUrl($planUrl)->first()) {
            return redirect()->back();
        }

        $plan->details()->create($request->all());

        return redirect()
            ->route('details.plan.index', $plan->url)
            ->with('message', 'Criado com sucesso!');
    }

    public function edit($planUrl, $idDetail)
    {
        $plan = Plan::whereUrl($planUrl)->first();
        $detail = DetailPlan::find($idDetail);

        if(!$plan || !$detail) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.edit', [
            'plan' => $plan,
            'detail' => $detail
        ]);
    }

    public function update($planUrl, $idDetail, StoreUpdateDetailPlan $request)
    {
        $plan = Plan::whereUrl($planUrl)->first();
        $detail = DetailPlan::find($idDetail);

        if(!$plan || !$detail) {
            return redirect()->back();
        }

        $detail->update($request->all());

        return redirect()
            ->route('details.plan.index', $plan->url)
            ->with('message', 'Alterado com sucesso!');
    }

    public function destroy($planUrl, $idDetail)
    {
        $plan = Plan::whereUrl($planUrl)->first();
        $detail = DetailPlan::find($idDetail);

        if(!$plan || !$detail) {
            return redirect()->back();
        }

        $detail->delete();

        return redirect()
            ->route('details.plan.index', $plan->url)
            ->with('message', 'Deletado com sucesso!');
    }
}
