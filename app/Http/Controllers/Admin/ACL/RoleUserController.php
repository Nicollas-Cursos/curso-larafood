<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleUserController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:users");
    }

    public function roles($userId)
    {
        if (!$user = User::find($userId)) {
            return redirect()->back();
        }

        $roles = $user->roles()->paginate();

        return view("admin.pages.users.roles.index", [
            "user" => $user,
            "roles" => $roles
        ]);
    }

    public function rolesAvailable($userId, Request $request)
    {
        if (!$user = User::find($userId)) {
            return redirect()->back();
        }

        $filters = $request->except("_token");

        $roles = $user->rolesAvailable($request->filter);

        return view("admin.pages.users.roles.available", [
            "user" => $user,
            "roles" => $roles,
            "filters" => $filters
        ]);
    }

    public function attachRolesUser($userId, Request $request)
    {
        if (!$request->roles) {
            return redirect()->back()->with("warning", "Marque alguma permissão para vincular.");
        }

        if (!$user = User::find($userId)) {
            return redirect()->back();
        }

        $user->roles()->attach($request->roles);

        return redirect()->route("user.roles", $user->id);
    }

    public function detachRoleUser($userId, $roleId)
    {
        if (!$user = User::find($userId)) {
            return redirect()->back();
        }

        if (!$role = Role::find($roleId)) {
            return redirect()->back();
        }

        $user->roles()->detach($role);

        return redirect()->route("user.roles", $user->id);
    }
}
