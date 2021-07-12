<?php

namespace App\Repositories;

use App\Models\Tenant;
use App\Repositories\Contracts\ITenantRepository;

class TenantRepository implements ITenantRepository
{
    public function getAllTenants()
    {
        return Tenant::all();
    }
}
