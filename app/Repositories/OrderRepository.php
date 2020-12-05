<?php


namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderRepository
 * @package App\Repositories
 */
class OrderRepository implements interfaces\OrderInterface
{

    /**
     * @param array $orderDetails
     * @return mixed
     */
    public function create(array $orderDetails)
    {
        return Order::create($orderDetails);
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllOrders()
    {
        return Order::with('customer', 'items')->get();
    }

    /**
     * @param int $id
     * @return Builder|Model|object|null
     */
    public function getOrder(int $id)
    {
        return Order::with('customer', 'items')->where('id', $id)->first();
    }

    public function getUnshippedOrders(int $productTypeId)
    {
        return Order::with(['customer',
            'items' => function ($q) use($productTypeId) {
               $q->where('shipped', false);
               $q->where('product_id', $productTypeId);
            }])->get();
    }


}
