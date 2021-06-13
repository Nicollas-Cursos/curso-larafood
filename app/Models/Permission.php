<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "description"
    ];

    public static function search($filter = null)
    {
        return Permission::query()
            ->where(function($query) use ($filter) {
                $query->where("name", "LIKE", "%{$filter}%")
                      ->orWhere("description", "LIKE", "%{$filter}%");
            })
            ->paginate();
    }
}
