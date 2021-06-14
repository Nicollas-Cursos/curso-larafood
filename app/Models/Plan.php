<?php

namespace App\Models;

use App\Models\Profile;
use App\Models\DetailPlan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "url", "price", "description"
    ];

    /**
     * Get Details Plan
     */
    public function details()
    {
        return $this->hasMany(DetailPlan::class);
    }

    /**
     * Get Profiles
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    public static function search($filter = null)
    {
        return Plan::query()
            ->where(function($query) use ($filter) {
                $query->where("name", "LIKE", "%{$filter}%")
                      ->orWhere("description", "LIKE", "%{$filter}%");
            })
            ->paginate();
    }

    /**
     * Profiles not linked with this plan
     */
    public function profilesAvailable($filter = null)
    {
        return Profile::whereNotIn("profiles.id", function ($query) {
            $query->select("plan_profile.profile_id")
                ->from("plan_profile")
                ->whereRaw("plan_profile.plan_id = {$this->id}");
        })->where(function ($query) use ($filter) {
            if (!$filter) return;

            $query->where("profiles.name", "LIKE", "%{$filter}%")
                ->orWhere("profiles.description", "LIKE", "%{$filter}%");
        })->paginate();
    }
}
