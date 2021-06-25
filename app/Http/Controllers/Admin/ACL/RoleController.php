<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRole;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:roles");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::latest()->paginate();

        return view("admin.pages.roles.index", [
            "roles" => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.roles.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateRole  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRole $request)
    {
        Role::create($request->all());

        return redirect()->route("roles.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$role = Role::find($id)) {
            return redirect()->back();
        }

        return view("admin.pages.roles.show", [
            "role" => $role
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
        if(!$role = Role::find($id)) {
            return redirect()->back();
        }

        return view("admin.pages.roles.edit", [
            "role" => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateRole  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, StoreUpdateRole $request)
    {
        if(!$role = Role::find($id)) {
            return redirect()->back();
        }

        $role->update($request->all());

        return redirect()->route("roles.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$role = Role::find($id)) {
            return redirect()->back();
        }

        $role->delete();

        return redirect()->route("roles.index");
    }

    public function search(Request $request)
    {
        $filters = $request->except("_token");
        $filteredRoles = Role::search($request->filter);

        return view("admin.pages.roles.index", [
            "roles" => $filteredRoles,
            "filters" => $filters
        ]);
    }
}
