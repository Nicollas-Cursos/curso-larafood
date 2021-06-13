<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "description"
    ];

    public static function search($filter = null)
    {
        return Profile::query()
            ->where(function ($query) use ($filter) {
                $query->where("name", "LIKE", "%{$filter}%")
                    ->orWhere("description", "LIKE", "%{$filter}%");
            })
            ->paginate();
    }

    /**
     * Get Permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Permissions not linked with this profile
     */
    public function permissionsAvailable($filter = null)
    {
        return Permission::whereNotIn("permissions.id", function ($query) {
            $query->select("permission_profile.permission_id")
                ->from("permission_profile")
                ->whereRaw("permission_profile.profile_id = {$this->id}");
        })
            ->where(function ($query) use ($filter) {
                if (!$filter) return;

                $query->where("permissions.name", "LIKE", "%{$filter}%")
                    ->orWhere("permissions.description", "LIKE", "%{$filter}%");
            })->paginate();
    }
}
