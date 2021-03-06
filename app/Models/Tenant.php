<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        "cnpj", "name", "url", "email", "logo",
        "active", "subscription", "expires_at",
        "subscription_id", "subscription_active",
        "subcription_suspended"
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public static function search($filter = null)
    {
        return Tenant::query()
            ->where(function ($query) use ($filter) {
                $query->where("name", "LIKE", "%{$filter}%");
            })
            ->latest()
            ->paginate();
    }
}
