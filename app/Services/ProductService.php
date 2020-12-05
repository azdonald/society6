<?php


namespace App\Services;


use App\Exceptions\InvalidRequestException;
use App\Repositories\interfaces\ProductInterface;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService
{
    private $productRepository;
    private $validationService;

    /**
     * ProductService constructor.
     * @param $productRepository
     * @param $validationService
     */
    public function __construct(ProductInterface $productRepository, ValidationService $validationService)
    {
        $this->productRepository = $productRepository;
        $this->validationService = $validationService;
    }

    /**
     * @param array $productDetails
     * @return mixed
     * @throws InvalidRequestException
     */
    public function addProduct(array $productDetails)
    {
        try {
            $this->validationService->validate($productDetails, $this->productRules(), $this->validationMessage());
            return $this->productRepository->create($productDetails);
        }catch (InvalidRequestException $e) {
            throw new InvalidRequestException($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getProduct(int $id)
    {
        return $this->productRepository->getProduct($id);
    }

    /**
     * @return mixed
     */
    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    /**
     * @return string[]
     */
    private function productRules(): array
    {
        return [
            'name' => 'required',
            'sku' => 'required|unique:products',
            'price' => 'required',
            'creative_id' => 'required|exists:creatives,id',
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
            'creative_id.exists' => 'No creative with that ID',
            'product_type_id.exists' => 'No product type with that ID',
        ];
    }


}
