<?php


namespace App\Repositories;


use App\Models\ProductType;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ProductTypeRepository
 * @package App\Repositories
 */
class ProductTypeRepository implements interfaces\ProductTypeInterface
{

    /**
     * @param array $productTypeDetails
     * @return mixed
     */
    public function create(array $productTypeDetails)
    {
        return ProductType::create($productTypeDetails);
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        ProductType::findOrFail($id)->delete();
    }

    /**
     * @return ProductType[]|Collection
     */
    public function getAllProductTypes()
    {
        return ProductType::all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getProductType(int $id)
    {
        return ProductType::findOrFail($id);
    }

    /**
     * @param ProductType $productType
     * @param array $productTypeDetails
     * @return ProductType
     */
    public function update(ProductType $productType, array $productTypeDetails): ProductType
    {
       $productType->update($productTypeDetails);
       return $productType;
    }
}
