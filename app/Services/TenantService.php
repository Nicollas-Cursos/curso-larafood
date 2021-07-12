<?php

namespace App\Services;

use App\Models\Plan;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\ITenantRepository;

class TenantService
{
    /** @var object */
    protected $plan;

    /** @var array */
    protected $data = [];

    /** @var object */
    protected $iRepository;

    public function __construct(ITenantRepository $repository)
    {
        $this->iRepository = $repository;
    }

    public function getAllTenants()
    {
        return $this->iRepository->getAllTenants();
    }

    public function make(Plan $plan, Array $data)
    {
        $this->plan = $plan;
        $this->data = $data;

        $tenant = $this->storeTenant();

        return $this->storeUser($tenant);
    }

    public function storeTenant()
    {
        return $this->plan->tenants()->create([
            'cnpj' => $this->data['tenant_cnpj'],
            'name' => $this->data['tenant_name'],
            'email' => $this->data['email'],

            'subscription' => now(),
            'expires_at' => now()->addDays(7)
        ]);
    }

    public function storeUser($tenant)
    {
        return $tenant->users()->create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => Hash::make($this->data['password']),
        ]);
    }
}
