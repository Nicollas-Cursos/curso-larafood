<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\TenantService;
use App\Http\Controllers\Controller;
use App\Http\Resources\TenantResource;

class TenantApiController extends Controller
{
    protected $service;

    public function __construct(TenantService $service)
    {
        $this->service = $service;    
    }

    public function index()
    {
        return TenantResource::collection($this->service->getAllTenants());
    }
}
