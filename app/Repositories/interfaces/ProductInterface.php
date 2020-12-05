<?php


namespace App\Repositories\interfaces;


use App\Models\Product;

/**
 * Interface ProductInterface
 * @package App\Repositories\interfaces
 */
interface ProductInterface
{
    public function create(array $productDetails);
    public function delete(int $id);
    public function getAllProducts();
    public function getProduct(int $id);
    public function update(Product $product, array $productDetails);
}
