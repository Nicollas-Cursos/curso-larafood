<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Profile;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilePermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:permissions");
    }

    public function profiles($permissionId)
    {
        if (!$permission = Permission::find($permissionId)) {
            return redirect()->back();
        }

        $profiles = $permission->profiles()->paginate();

        return view("admin.pages.permissions.profiles.index", [
            "permission" => $permission,
            "profiles" => $profiles
        ]);
    }

    public function profilesAvailable($permissionId, Request $request)
    {
        if (!$permission = Permission::find($permissionId)) {
            return redirect()->back();
        }

        $filters = $request->except("_token");

        $profiles = $permission->profilesAvailable($request->filter);

        return view("admin.pages.permissions.profiles.available", [
            "permission" => $permission,
            "profiles" => $profiles,
            "filters" => $filters
        ]);
    }

    public function attachProfilePermission($permissionId, Request $request)
    {
        if (!$request->profiles) {
            return redirect()->back()->with("warning", "Marque algum perfil para vincular.");
        }

        if (!$permission = Permission::find($permissionId)) {
            return redirect()->back();
        }

        $permission->profiles()->attach($request->profiles);

        return redirect()->route("permission.profiles", $permission->id);
    }

    public function detachProfilePermission($permissionId, $profileId)
    {
        if (!$permission = Permission::find($permissionId)) {
            return redirect()->back();
        }

        if (!$profile = Profile::find($profileId)) {
            return redirect()->back();
        }

        $permission->profiles()->detach($profile);

        return redirect()->route("permission.profiles", $permission->id);
    }
}
