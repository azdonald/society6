<?php


namespace App\Services;


use App\Exceptions\InvalidRequestException;
use App\Repositories\interfaces\OrderLineItemInterface;

/**
 * Class OrderItemService
 * @package App\Services
 */
class OrderItemService
{
    private $orderItemRepository;
    private $validationService;

    /**
     * OrderItemService constructor.
     * @param $orderItemRepository
     * @param $validationService
     */
    public function __construct(OrderLineItemInterface $orderItemRepository, ValidationService $validationService)
    {
        $this->orderItemRepository = $orderItemRepository;
        $this->validationService = $validationService;
    }

    public function createOrderItem(array $lineItem)
    {
        try {
            $this->validationService->validate($lineItem, $this->orderItemRules(), $this->validationMessage());
            return $this->orderItemRepository->create($lineItem);
        }catch (InvalidRequestException $e) {
            throw new InvalidRequestException($e->getMessage());
        }
    }

    public function getOrderItem(int $id)
    {
        return $this->orderItemRepository->getById($id);
    }

    public function update(int $id, array $data)
    {
        $item = $this->orderItemRepository->getById($id);
        return $this->orderItemRepository->update($item, $data);
    }

    /**
     * @return string[]
     */
    private function orderItemRules(): array
    {
        return [
            'quantity' => 'required',
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id'
        ];
    }


    /**
     * @return string[]
     */
    private function validationMessage(): array
    {
        return $messages = [
            'required' => 'The :attribute field is required.',
            'order_id.exists' => 'No order with that ID',
            'product_id.exists' => 'No product  with that ID',
        ];
    }


}
