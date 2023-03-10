<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function create(ProductRequest $request): Response
    {
        $product = $this->productService->create($request);

        return response()->json($product);
    }

    public function list(Request $request): Response
    {
        $response = $this->productService->findAll($request);

        return response()->json($response);
    }
}
