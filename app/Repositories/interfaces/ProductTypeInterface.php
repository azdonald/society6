<?php


namespace App\Repositories\interfaces;


use App\Models\ProductType;

/**
 * Interface ProductTypeInterface
 * @package App\Repositories\interfaces
 */
interface ProductTypeInterface
{
    public function create(array $productTypeDetails);
    public function delete(int $id);
    public function getAllProductTypes();
    public function getProductType(int $id);
    public function update(ProductType $productType, array $productTypeDetails);
}
