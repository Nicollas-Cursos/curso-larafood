<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "description"
    ];

    /**
     * Get Permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public static function search($filter = null)
    {
        return Role::query()
            ->where(function ($query) use ($filter) {
                $query->where("name", "LIKE", "%{$filter}%")
                    ->orWhere("description", "LIKE", "%{$filter}%");
            })
            ->paginate();
    }

    /**
     * Profiles not linked with this permission
     */
    public function profilesAvailable($filter = null)
    {
        return Profile::whereNotIn("permissions.id", function ($query) {
            $query->select("permission_role.permission_id")
                ->from("permission_role")
                ->whereRaw("permission_role.profile_id = {$this->id}");
        })->where(function ($query) use ($filter) {
            if (!$filter) return;

            $query->where("permissions.name", "LIKE", "%{$filter}%");
        })->paginate();
    }
}
