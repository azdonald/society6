<?php


namespace App\Http\Controllers;


use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class OrderController
 * @package App\Http\Controllers
 */
class OrderController extends Controller
{
    private $orderService;

    /**
     * OrderController constructor.
     * @param $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \App\Exceptions\InvalidRequestException
     */
    public function create(Request $request): JsonResponse
    {
        $order = $this->orderService->createOrder($request->all());
        return response()->json($order, 201);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function getOrder(Request $request, $id): JsonResponse
    {
        $order = $this->orderService->getOrder($id);
        return response()->json($order, 200);
    }

    public function getAllOrders(Request $request)
    {
        $orders = $this->orderService->getAllOrders();
        return response()->json($orders, 200);
    }

}
