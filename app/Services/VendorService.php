<?php


namespace App\Services;


use App\Exceptions\InvalidRequestException;
use App\Repositories\interfaces\VendorInterface;
use Illuminate\Support\Facades\Hash;

class VendorService
{
    private $vendorRepository;
    private $validationService;
    private $tokenService;
    private $productTypeService;
    private $orderService;
    private $orderItemService;

    /**
     * VendorService constructor.
     * @param VendorInterface $vendorRepository
     * @param ValidationService $validationService
     * @param TokenService $tokenService
     * @param ProductTypeService $productTypeService
     */
    public function __construct(VendorInterface $vendorRepository, ValidationService $validationService,
                                TokenService $tokenService, ProductTypeService $productTypeService,
                                OrderService $orderService, OrderItemService $itemService)
    {
        $this->vendorRepository = $vendorRepository;
        $this->validationService = $validationService;
        $this->tokenService = $tokenService;
        $this->productTypeService = $productTypeService;
        $this->orderService = $orderService;
        $this->orderItemService = $itemService;
    }

    /**
     * @param array $vendorDetails
     * @return mixed
     * @throws InvalidRequestException
     */
    public function createVendor(array $vendorDetails)
    {
        try {
            $this->validationService->validate($vendorDetails, $this->userRules(), $this->validationMessage());
            $vendorDetails['password'] = Hash::make($vendorDetails['password']);
            $vendor = $this->vendorRepository->create($vendorDetails);
            $productType = $this->productTypeService->getProductType($vendorDetails['product_type_id']);
            $vendor->productTypes()->attach($productType->id);
            return $vendor;
        }catch (InvalidRequestException $e) {
            throw new InvalidRequestException($e->getMessage());
        }
    }

    /**
     * @param array $credentials
     * @return string
     */
    public function login(array $credentials): string
    {
        $vendor = $this->vendorRepository->login($credentials);
        return $this->tokenService->generateToken($vendor->id, "vendor");
    }

    /**
     * @param int $id
     */
    public function getVendorOrders(int $id)
    {
        $vendor = $this->vendorRepository->getVendorProductType($id);
        $orders = $this->orderService->getUnshippedOrders($vendor->productTypes[0]->id);
        return [$orders, $vendor->response_format];
    }

    public function notifyShipped(int $id, array $data)
    {
        return $this->orderItemService->update($id, $data);
    }

    /**
     * @return string[]
     */
    private function userRules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:vendors',
            'password' => 'required',
            'product_type_id' => 'required|exists:product_types,id'
        ];
    }


    /**
     * @return string[]
     */
    private function validationMessage(): array
    {
        return $messages = [
            'required' => 'The :attribute field is required.',
            'email.unique' => 'We already have a vendor with :attribute registered',
            'product_type_id.exists' => 'No product type with that ID',
        ];
    }


}
