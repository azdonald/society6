<?php


namespace App\Services;


use App\Repositories\CustomerRepository;
use App\Repositories\interfaces\CustomerInterface;

class CustomerService
{
    private $customerRepository;
    private $validationService;

    /**
     * CustomerService constructor.
     * @param CustomerInterface $customerRepository
     * @param ValidationService $validationService
     */
    public function __construct(CustomerInterface $customerRepository, ValidationService $validationService)
    {
        $this->customerRepository = $customerRepository;
        $this->validationService = $validationService;
    }

    /**
     * @param array $customerDetails
     * @return mixed
     * @throws \App\Exceptions\InvalidRequestException
     */
    public function createCustomer(array $customerDetails)
    {
        try {
            $this->validationService->validate($customerDetails, $this->customerRules(), $this->validationMessage());
            return $this->customerRepository->create($customerDetails);
        }catch (InvalidRequestException $e) {
            throw new InvalidRequestException($e->getMessage());
        }
    }

    /**
     * @return string[]
     */
    private function customerRules(): array
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'country' => 'required'
        ];
    }


    /**
     * @return string[]
     */
    private function validationMessage(): array
    {
        return $messages = [
            'required' => 'The :attribute field is required.',
        ];
    }


}
