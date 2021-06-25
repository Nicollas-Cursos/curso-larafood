<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:roles");
    }

    public function permissions($roleId)
    {
        if (!$role = Role::find($roleId)) {
            return redirect()->back();
        }

        $permissions = $role->permissions()->paginate();

        return view("admin.pages.roles.permissions.index", [
            "role" => $role,
            "permissions" => $permissions
        ]);
    }

    public function permissionsAvailable($roleId, Request $request)
    {
        if (!$role = Role::find($roleId)) {
            return redirect()->back();
        }

        $filters = $request->except("_token");

        $permissions = $role->permissionsAvailable($request->filter);

        return view("admin.pages.roles.permissions.available", [
            "role" => $role,
            "permissions" => $permissions,
            "filters" => $filters
        ]);
    }

    public function attachPermissionsRole($roleId, Request $request)
    {
        if (!$request->permissions) {
            return redirect()->back()->with("warning", "Marque alguma permissão para vincular.");
        }

        if (!$role = Role::find($roleId)) {
            return redirect()->back();
        }

        $role->permissions()->attach($request->permissions);

        return redirect()->route("role.permissions", $role->id);
    }

    public function detachPermissionRole($roleId, $permissionId)
    {
        if (!$role = Role::find($roleId)) {
            return redirect()->back();
        }

        if (!$permission = Permission::find($permissionId)) {
            return redirect()->back();
        }

        $role->permissions()->detach($permission);

        return redirect()->route("role.permissions", $role->id);
    }
}
