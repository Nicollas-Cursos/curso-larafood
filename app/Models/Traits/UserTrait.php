<?php

namespace App\Models\Traits;

use App\Models\Tenant;

trait UserTrait
{
    public function permissions(): Array
    {
        $permissionsPlan = $this->permissionsPlan();
        $permissionsRole = $this->permissionsRole();
        $permissions = [];

        foreach($permissionsRole as $permissionRole) {
            if(in_array($permissionRole, $permissionsPlan)) {
                $permissions[] = $permissionRole;
            }
        }

        return $permissions;
    }

    public function permissionsPlan(): Array
    {
        $tenant = Tenant::with('plan.profiles.permissions')->find($this->tenant_id);
        $plan = $tenant->plan;
        $permissions = [];

        foreach($plan->profiles as $profile) {
            foreach($profile->permissions as $permission) {
                $permissions[] = $permission->name;
            }
        }

        return $permissions;
    }

    public function permissionsRole(): Array
    {
        $roles = $this->roles()->with('permissions')->get();
        $permissions = [];

        foreach($roles->permissions as $permission) {
            $permissions[] = $permission->name;
        }

        return $permissions;
    }

    public function hasPermission(String $permissionName): bool
    {
        return in_array($permissionName, $this->permissions());
    }

    public function isAdmin(): bool
    {
        return in_array($this->email, config("tenant.admins"));
    }

    public function isTenant(): bool
    {
        return !$this->isAdmin();
    }
}
