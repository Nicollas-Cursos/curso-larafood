<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'name', 'url', 'description'
    ];

    public static function search($filter = null)
    {
        return Category::query()
            ->where(function($query) use ($filter) {
                $query->where("name", "LIKE", "%{$filter}%")
                      ->orWhere("description", "LIKE", "%{$filter}%");
            })
            ->paginate();
    }
}
