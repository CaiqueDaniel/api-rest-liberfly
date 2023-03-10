<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

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
}
