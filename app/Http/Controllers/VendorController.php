<?php


namespace App\Http\Controllers;


use App\Models\Order;
use App\Services\VendorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class VendorController
 * @package App\Http\Controllers
 */
class VendorController extends Controller
{
    private $vendorService;

    public function __construct(VendorService  $vendorService)
    {
        $this->vendorService = $vendorService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \App\Exceptions\InvalidRequestException
     */
    public function register(Request $request): JsonResponse
    {
        $vendor = $this->vendorService->createVendor($request->all());
        return response()->json($vendor, 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $user = $this->vendorService->login($request->all());
        return response()->json($user, 201);

    }

    public function getOrders(Request $request)
    {
        $result = $this->vendorService->getVendorOrders($request->input('vendor_id'));
        if ($result[1] == 'xml') {
            return response()->xml($this->xmlFormat($result[0]->first()));
        }
        return response()->json($this->toJsonFormat($result[0]->first()));
    }

    public function notifyShipped(Request $request, $id)
    {
        $this->vendorService->notifyShipped($id, $request->all());
        return response()->json([], 200);
    }

    private function xmlFormat(Order $order)
    {
        return [
            'orders' => [
                'order' => [
                    'order_number' => $order->id,
                    'customer_data' => [
                        'first_name' => $order->customer->firstname,
                        'last_name' => $order->customer->lastname,
                        'address1' => $order->customer->address,
                        'city' => $order->customer->city,
                        'state' => $order->customer->state,
                        'zip' => $order->customer->postcode,
                        'country' => $order->customer->country,
                    ],
                    'items' => [
                        'item' => $this->generateItems($order->items->toArray()),
                    ]
                ]
            ]
        ];
    }

    public function toJsonFormat($orders)
    {
        return [
            'data' => [
                'orders' => $this->generateJsonStruct($orders)
            ]
        ];
    }

    private function generateJsonStruct($order)
    {
        return [
            "external_order_id" => $order->id,
            "buyer_first_name" => $order->customer->firstname,
            "buyer_last_name" => $order->customer->lastname,
            "buyer_shipping_address_1" => $order->customer->address,
            "buyer_shipping_city" => $order->customer->city,
            "buyer_shipping_state" => $order->customer->state,
            "buyer_shipping_postal" => $order->customer->postalcode,
            "buyer_shipping_country" => $order->customer->country,
            "print_line_items" => $this->generateJsonItems($order->items->toArray())
        ];
    }

    private function generateJsonItems(array $lineItems)
    {
        $items = [];
        foreach ($lineItems as $item) {
            $items['external_ order_line_item_id'] = $item['id'];
            $items ['product_id'] = $item['product_id'];
            $items ['quantity'] = $item['quantity'];

        }

        return $items;
    }
    private function generateItems(array $lineItems)
    {

        $items = [];
        foreach ($lineItems as $item) {
            $items['order_line_item_id'] = $item['id'];
            $items ['product_id'] = $item['product_id'];
            $items ['quantity'] = $item['quantity'];

        }

        return $items;
    }
}
