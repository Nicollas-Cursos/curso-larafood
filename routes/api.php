<?php

use App\Http\Controllers\Api\TenantApiController;

Route::get('/tenants', [TenantApiController::class, 'index']);