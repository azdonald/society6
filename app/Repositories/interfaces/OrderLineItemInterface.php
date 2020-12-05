<?php


namespace App\Repositories\interfaces;

use App\Models\OrderLineItem;

/**
 * Interface OrderLineItemInterface
 * @package App\Repositories\interfaces
 */
interface OrderLineItemInterface
{
    public function create(array $lineItems);
    public function getById(int $id);
    public function update(OrderLineItem $lineItem, array $lineItems);

}
