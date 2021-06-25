<?php

namespace App\Models;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "description"
    ];

    public static function search($filter = null)
    {
        return Permission::query()
            ->where(function ($query) use ($filter) {
                $query->where("name", "LIKE", "%{$filter}%")
                    ->orWhere("description", "LIKE", "%{$filter}%");
            })
            ->paginate();
    }

    /**
     * Get Profiles
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    /**
     * Get Roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Profiles not linked with this permission
     */
    public function profilesAvailable($filter = null)
    {
        return Profile::whereNotIn("profiles.id", function ($query) {
            $query->select("permission_profile.profile_id")
                ->from("permission_profile")
                ->whereRaw("permission_profile.permission_id = {$this->id}");
        })->where(function ($query) use ($filter) {
            if (!$filter) return;

            $query->where("profiles.name", "LIKE", "%{$filter}%")
                ->orWhere("profiles.description", "LIKE", "%{$filter}%");
        })->paginate();
    }
}
