<?php

namespace App\Tenant;

use App\Models\Tenant;

class ManagerTenant
{
    public function getTenantIdentifier()
    {
        return auth()->user()->tenant_id;
    }

    public function getTenant(): Tenant
    {
        return auth()->user()->tenant;
    }

    public function getTenantUuid()
    {
        return $this->getTenant()->uuid;
    }

    public function isSuperAdmin(?String $email = null): bool
    {
        $email = $email ?: auth()->user()->email;

        return in_array(
            $email,
            config('tenant.admins')
        );
    }
}
