<?php


namespace App\Repositories;


use App\Models\OrderLineItem;

/**
 * Class OrderLineItemRepository
 * @package App\Repositories
 */
class OrderLineItemRepository implements interfaces\OrderLineItemInterface
{

    /**
     * @param array $lineItems
     * @return mixed
     */
    public function create(array $lineItems)
    {
        return OrderLineItem::create($lineItems);
    }    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function getById(int $id)
    {
        return OrderLineItem::findOrFail($id);
    }

    public function update(OrderLineItem $lineItem, array $lineItems)
    {
        return $lineItem->update($lineItems);
    }


}
