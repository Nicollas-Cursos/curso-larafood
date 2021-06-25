<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUpdateTenant;

class TenantController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:tenants");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = Tenant::latest()->paginate();

        return view("admin.pages.tenants.index", [
            "tenants" => $tenants
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.tenants.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateTenant  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTenant $request)
    {        
        Tenant::create($request->all());

        return redirect()->route("tenants.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$tenant = Tenant::with('plan')->find($id)) {
            return redirect()->back();
        }

        return view("admin.pages.tenants.show", [
            "tenant" => $tenant
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$tenant = Tenant::find($id)) {
            return redirect()->back();
        }

        return view("admin.pages.tenants.edit", [
            "tenant" => $tenant
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateTenant  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTenant $request, $id)
    {
        if (!$tenant = Tenant::find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        if($request->hasFile('logo') && $request->logo->isValid()) {

            if(Storage::exists($tenant->logo)) {
                Storage::delete($tenant->logo);
            }

            $data["logo"] = $request->logo->store("tenants/{$tenant->uuid}/logo");
        }

        $tenant->update($data);

        return redirect()->route("tenants.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$tenant = Tenant::find($id)) {
            return redirect()->back();
        }

        if(Storage::exists($tenant->logo)) {
            Storage::delete($tenant->logo);
        }

        $tenant->delete();

        return redirect()->route("tenants.index");
    }

    public function search(Request $request)
    {
        $filters = $request->except("_token");
        $filteredCategories = Tenant::search($request->filter);

        return view("admin.pages.tenants.index", [
            "tenants" => $filteredCategories,
            "filters" => $filters
        ]);
    }
}
