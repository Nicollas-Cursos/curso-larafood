<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePermission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::latest()->paginate();

        return view("admin.pages.permissions.index", [
            "permissions" => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.permissions.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdatePermission  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePermission $request)
    {
        Permission::create($request->all());

        return redirect()->route("permissions.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$permission = Permission::find($id)) {
            return redirect()->back();
        }

        return view("admin.pages.permissions.show", [
            "permission" => $permission
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
        if(!$permission = Permission::find($id)) {
            return redirect()->back();
        }

        return view("admin.pages.permissions.edit", [
            "permission" => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdatePermission  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, StoreUpdatePermission $request)
    {
        if(!$permission = Permission::find($id)) {
            return redirect()->back();
        }

        $permission->update($request->all());

        return redirect()->route("permissions.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$permission = Permission::find($id)) {
            return redirect()->back();
        }

        $permission->delete();

        return redirect()->route("permissions.index");
    }

    public function search(Request $request)
    {
        $filters = $request->except("_token");
        $filteredPermissions = Permission::search($request->filter);

        return view("admin.pages.permissions.index", [
            "permissions" => $filteredPermissions,
            "filters" => $filters
        ]);
    }
}
