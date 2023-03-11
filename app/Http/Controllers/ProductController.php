<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    private ProductService $productService;

    //Services serão injetados no controller via reflection
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @OA\Post(
     *      path="/products",
     *      tags={"Produto"},
     *      summary="Cadastrar produto",
     *      description="Cadastra um novo produto",
     *      security={{"bearer_token":{}}},
     *
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="sku", type="string", example="QWERTY"),
     *              @OA\Property(property="name", type="string", example="Nome do produto"),
     *              @OA\Property(property="description", type="string|null", example="Descrição do produto"),
     *              @OA\Property(property="price", type="string", example="120.90"),
     *              @OA\Property(property="stock", type="int", example="5")
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Produto criado com sucesso",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="int", example="1"),
     *              @OA\Property(property="sku", type="string", example="QWERTY"),
     *              @OA\Property(property="name", type="string", example="Nome do produto"),
     *              @OA\Property(property="description", type="string|null", example="Descrição do produto"),
     *              @OA\Property(property="price", type="string", example="120.90"),
     *              @OA\Property(property="stock", type="int", example="5"),
     *              @OA\Property(property="updated_at", type="string", example="2022-11-14T00:06:03.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2022-11-14T00:06:03.000000Z")
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=400,
     *          description="Ao falhar em uma validação",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="sku", type="array", items=@OA\Items()),
     *              )
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="Não foi possivel validar o acesso",
     *
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Não foi possivel validar o acesso")
     *          )
     *      )
     * )
     */
    public function create(ProductRequest $request): Response
    {
        $product = $this->productService->create($request);

        return response()->json($product);
    }

    /**
     * @OA\Get (
     *      path="/products",
     *      tags={"Produto"},
     *      summary="Listar produtos",
     *      description="Lista todos os produtos",
     *      security={{"bearer_token":{}}},
     *
     *      @OA\Response(
     *          response=200,
     *          description="Produtos lisitados com sucesso.",
     *
     *          @OA\JsonContent(
     *              @OA\Property(property="current_page", type="int", example="1"),
     *              @OA\Property(property="first_page_url", type="string", example="http://localhost:8000/api/products?page=1"),
     *              @OA\Property(property="from", type="int", example="1"),
     *              @OA\Property(property="next_page_url", type="string|null", example="http://localhost:8000/api/products?page=2"),
     *              @OA\Property(property="prev_page_url", type="string|null", example="null"),
     *              @OA\Property(property="path", type="string", example="http://localhost:8000/api/products"),
     *              @OA\Property(property="per_page", type="int", example="30"),
     *              @OA\Property(property="to", type="int", example="1"),
     *              @OA\Property(property="data", type="array", items=@OA\Items(
     *                      @OA\Property(property="id", type="int", example="1"),
     *                      @OA\Property(property="sku", type="string", example="QWERTY"),
     *                      @OA\Property(property="name", type="string", example="Nome do produto"),
     *                      @OA\Property(property="description", type="string|null", example="Descrição do produto"),
     *                      @OA\Property(property="price", type="string", example="120.90"),
     *                      @OA\Property(property="stock", type="int", example="5"),
     *                      @OA\Property(property="updated_at", type="string", example="2022-11-14T00:06:03.000000Z"),
     *                      @OA\Property(property="created_at", type="string", example="2022-11-14T00:06:03.000000Z")
     *                  )
     *              ),
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="Não foi possivel validar o acesso",
     *
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Não foi possivel validar o acesso")
     *          )
     *      ),
     * )
     */
    public function list(Request $request): Response
    {
        $response = $this->productService->findAll($request);

        return response()->json($response);
    }

    /**
     * @OA\Get (
     *      path="/products/{id}",
     *      tags={"Produto"},
     *      summary="Recuperar produto",
     *      description="Recuperar produto por ID",
     *      security={{"bearer_token":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Produto recuperado com sucesso",
     *
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="int", example="1"),
     *              @OA\Property(property="sku", type="string", example="QWERTY"),
     *              @OA\Property(property="name", type="string", example="Nome do produto"),
     *              @OA\Property(property="description", type="string|null", example="Descrição do produto"),
     *              @OA\Property(property="price", type="string", example="120.90"),
     *              @OA\Property(property="stock", type="int", example="5"),
     *              @OA\Property(property="updated_at", type="string", example="2022-11-14T00:06:03.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2022-11-14T00:06:03.000000Z")
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="Não foi possivel validar o acesso",
     *
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Não foi possivel validar o acesso")
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=404,
     *          description="Produto não encontrado",
     *
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Produto não encontrado"),
     *          )
     *      )
     * )
     */
    public function view(int $id): Response
    {
        $product = $this->productService->findOne($id);

        return response()->json($product);
    }
}
