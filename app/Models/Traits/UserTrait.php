<?php

namespace App\Models\Traits;

trait UserTrait
{
    public function permissions()
    {
        $plan = $this->tenant->plan;
        $permissions = [];

        foreach($plan->profiles as $profile) {
            foreach($profile->permissions as $permission) {
                $permissions[] = $permission->name;
            }
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
