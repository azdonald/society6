<?php


namespace App\Services;


use App\Repositories\interfaces\ProductTypeInterface;

class ProductTypeService
{
    private $productTypeRepository;

    /**
     * ProductTypeService constructor.
     * @param $productTypeRepository
     */
    public function __construct(ProductTypeInterface $productTypeRepository)
    {
        $this->productTypeRepository = $productTypeRepository;
    }


    public function getProductType(int $id)
    {
        return $this->productTypeRepository->getProductType($id);
    }


}
