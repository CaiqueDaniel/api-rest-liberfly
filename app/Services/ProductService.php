<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ProductService
{
    /**
     * @throws \Throwable
     */
    public function create(ProductRequest $request): Product
    {
        $product = new Product($request->validated());
        $product->saveOrFail();

        return $product;
    }

    public function findAll(Request $request): Paginator
    {
        $page = (int)$request->get("page");
        $page = $page <= 0 ? 1 : $page;

        return Product::findAll($page);
    }
}
