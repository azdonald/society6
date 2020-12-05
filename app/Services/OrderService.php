<?php


namespace App\Services;


use App\Repositories\interfaces\OrderInterface;

/**
 * Class OrderService
 * @package App\Services
 */
class OrderService
{
    private $orderRepository;
    private $customerService;
    private $orderItemService;
    private $validationService;

    /**
     * OrderService constructor.
     * @param OrderInterface $orderRepository
     * @param CustomerService $customerService
     * @param OrderItemService $itemService
     * @param ValidationService $validationService
     */
    public function __construct(OrderInterface $orderRepository, CustomerService $customerService,
                                OrderItemService $itemService, ValidationService $validationService)
    {
        $this->orderRepository = $orderRepository;
        $this->customerService = $customerService;
        $this->orderItemService = $itemService;
        $this->validationService = $validationService;
    }

    /**
     * @param array $orderDetails
     * @return mixed
     * @throws \App\Exceptions\InvalidRequestException
     */
    public function createOrder(array $orderDetails)
    {
        try {
            $this->validationService->validate($orderDetails, $this->orderRules(), $this->validationMessage());
            $customer = $this->customerService->createCustomer($orderDetails['customer']);
            $orderDetails['customer_id'] = $customer->id;
            $order = $this->orderRepository->create($orderDetails);
            foreach ($orderDetails['items'] as $item) {
                $itemDetails = (array) $item;
                $itemDetails['order_id'] = $order->id;
                $savedItem = $this->orderItemService->createOrderItem($itemDetails);
            }
            return $this->getOrder($order->id);
        }catch (InvalidRequestException $e) {
            throw new InvalidRequestException($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function getAllOrders()
    {
        return $this->orderRepository->getAllOrders();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getOrder(int $id)
    {
        return $this->orderRepository->getOrder($id);
    }

    public function getUnshippedOrders(int $productTypeId)
    {
        return $this->orderRepository->getUnshippedOrders($productTypeId);
    }

    /**
     * @return string[]
     */
    private function orderRules(): array
    {
        return [
            'amount' => 'required',
        ];
    }


    /**
     * @return string[]
     */
    private function validationMessage(): array
    {
        return $messages = [
            'required' => 'The :attribute field is required.',
        ];
    }


}
