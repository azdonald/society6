<?php


namespace App\Repositories\interfaces;

/**
 * Interface CustomerInterface
 * @package App\Repositories\interfaces
 */
interface CustomerInterface
{
    public function create(array $customerDetails);
    public function getCustomer(int $id);

}
