<?php

namespace App\Listeners;

use App\Models\Role;
use App\Tenant\Events\TenantCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddRoleToTenant
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TenantCreated $event)
    {
        $user = $event->user();

        if (!$role = Role::first()) return;

        return $user->roles()->attach($role);
    }
}
