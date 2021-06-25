<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'title', 'description', 'flag', 'price', 'image'
    ];

    /**
     * Return all categories of this product
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public static function search($filter = null)
    {
        return Category::query()
            ->where(function($query) use ($filter) {
                $query->where("title", "LIKE", "%{$filter}%")
                      ->orWhere("description", "LIKE", "%{$filter}%");
            })
            ->paginate();
    }
}
