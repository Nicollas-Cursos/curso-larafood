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

    public function categoriesAvailable($filter = null)
    {
        return Category::whereNotIn("categories.id", function ($query) {
            $query->select("category_product.category_id")
                ->from("category_product")
                ->whereRaw("category_product.product_id = {$this->id}");
        })->where(function ($query) use ($filter) {
            if (!$filter) return;

            $query->where("categories.name", "LIKE", "%{$filter}%");
        })->paginate();
    }
}
