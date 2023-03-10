<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Product extends Model
{
    use HasFactory;

    const MAX_PER_PAGE = 30;

    protected $fillable = ['sku', 'name', 'description', 'price', 'stock'];

    public static function findAll(int $page = 1): Paginator
    {
        return static::offset($page > 0 ? ($page * static::MAX_PER_PAGE) : static::MAX_PER_PAGE)
            ->simplePaginate(static::MAX_PER_PAGE);
    }

    public static function findById(int $id): ?Product
    {
        return static::where('id', '=', $id)->first();
    }
}
