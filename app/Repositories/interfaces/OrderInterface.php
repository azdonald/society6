<?php


namespace App\Repositories\interfaces;

/**
 * Interface OrderInterface
 * @package App\Repositories\interfaces
 */
interface OrderInterface
{
    public function create(array $orderDetails);
    public function getAllOrders();
    public function getOrder(int $id);
    public function getUnshippedOrders(int $productTypeId);
}
