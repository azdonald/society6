<?php


namespace App\Repositories;


use App\Models\Product;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
class ProductRepository implements interfaces\ProductInterface
{

    /**
     * @param array $productDetails
     * @return mixed
     */
    public function create(array $productDetails)
    {
        return Product::create($productDetails);
    }

    public function delete(int $id)
    {
        Product::findOrFail($id)->delete();
    }

    public function getAllProducts()
    {
        return Product::with('creatives', 'types')->get();
    }

    public function getProduct(int $id)
    {
        return Product::with('creatives', 'types')->findOrFail($id);
    }

    public function update(Product $product, array $productDetails)
    {
        // TODO: Implement update() method.
    }
}
