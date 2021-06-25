<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Profile;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:profiles");
    }

    public function permissions($profileId)
    {
        if (!$profile = Profile::find($profileId)) {
            return redirect()->back();
        }

        $permissions = $profile->permissions()->paginate();

        return view("admin.pages.profiles.permissions.index", [
            "profile" => $profile,
            "permissions" => $permissions
        ]);
    }

    public function permissionsAvailable($profileId, Request $request)
    {
        if (!$profile = Profile::find($profileId)) {
            return redirect()->back();
        }

        $filters = $request->except("_token");

        $permissions = $profile->permissionsAvailable($request->filter);

        return view("admin.pages.profiles.permissions.available", [
            "profile" => $profile,
            "permissions" => $permissions,
            "filters" => $filters
        ]);
    }

    public function attachPermissionsProfile($profileId, Request $request)
    {
        if (!$request->permissions) {
            return redirect()->back()->with("warning", "Marque alguma permissão para vincular.");
        }

        if (!$profile = Profile::find($profileId)) {
            return redirect()->back();
        }

        $profile->permissions()->attach($request->permissions);

        return redirect()->route("profile.permissions", $profile->id);
    }

    public function detachPermissionProfile($profileId, $permissionId)
    {
        if (!$profile = Profile::find($profileId)) {
            return redirect()->back();
        }

        if (!$permission = Permission::find($permissionId)) {
            return redirect()->back();
        }

        $profile->permissions()->detach($permission);

        return redirect()->route("profile.permissions", $profile->id);
    }
}
