<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Table extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'identify', 'description'
    ];

    public static function search($filter = null)
    {
        return Table::query()
            ->where(function($query) use ($filter) {
                $query->where("identify", "LIKE", "%{$filter}%");
            })
            ->paginate();
    }
}
