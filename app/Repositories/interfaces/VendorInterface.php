<?php


namespace App\Repositories\interfaces;

/**
 * Interface VendorInterface
 * @package App\Repositories\interfaces
 */
interface VendorInterface
{
    public function create(array $vendorDetails);
    public function login(array $credentials);
    public function getVendorProductType(int $id);
}
