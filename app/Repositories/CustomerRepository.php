<?php


namespace App\Repositories;


use App\Models\Customer;

/**
 * Class CustomerRepository
 * @package App\Repositories
 */
class CustomerRepository implements interfaces\CustomerInterface
{

    /**
     * @param array $customerDetails
     * @return mixed
     */
    public function create(array $customerDetails)
    {
        return Customer::firstOrCreate($customerDetails);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getCustomer(int $id)
    {
        return Customer::findOrFail($id);
    }
}
