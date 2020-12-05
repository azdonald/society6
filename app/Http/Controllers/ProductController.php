<?php


namespace App\Http\Controllers;


use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    /**
     * ProductController constructor.
     * @param $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\InvalidRequestException
     */
    public function create(Request $request)
    {
        $product = $this->productService->addProduct($request->all());
        return response()->json($product, 201);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProduct(Request $request, $id)
    {
        $product = $this->productService->getProduct($id);
        return response()->json($product, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllProducts(Request $request)
    {
        $products = $this->productService->getAllProducts();
        return response()->json($products, 200);
    }

    public function update(Request $request)
    {

    }
}
