<?php

namespace App\Models;

use App\Models\Traits\UserTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, UserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "email",
        "password",
        "tenant_id"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        "password",
        "remember_token",
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];

     /**
     * Scope a query to only include tenant user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTenantUser(Builder $query)
    {
        return $query->where('tenant_id', auth()->user()->tenant_id);
    }

    /**
     * Get tenant of this user
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get Roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public static function search($filter = null)
    {
        return User::query()
            ->where(function ($query) use ($filter) {
                $query->where("name", "LIKE", "%{$filter}%")
                    ->orWhere("email", $filter);
            })
            ->latest()
            ->tenantUser()
            ->paginate();
    }

    /**
     * Roles not linked with this permission
     */
    public function rolesAvailable($filter = null)
    {
        return Role::whereNotIn("roles.id", function ($query) {
            $query->select("role_user.role_id")
                ->from("role_user")
                ->whereRaw("role_user.user_id = {$this->id}");
        })->where(function ($query) use ($filter) {
            if (!$filter) return;

            $query->where("roles.name", "LIKE", "%{$filter}%");
        })->paginate();
    }
}
