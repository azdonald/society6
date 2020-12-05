<?php


namespace App\Repositories;


use App\Exceptions\InvalidRequestException;
use App\Models\Vendor;
use App\Repositories\interfaces\VendorInterface;
use Illuminate\Support\Facades\Hash;

/**
 * Class VendorRepository
 * @package App\Repositories
 */
class VendorRepository implements VendorInterface
{

    /**
     * @param array $vendorDetails
     * @return mixed
     */
    public function create(array $vendorDetails)
    {
        return Vendor::create($vendorDetails);
    }

    /**
     * @param array $credentials
     * @return mixed
     * @throws InvalidRequestException
     */
    public function login(array $credentials)
    {
        $vendor = Vendor::where('email', $credentials['email'])->first();
        if (!$vendor) {
            throw new InvalidRequestException("Email or Password is wrong");
        }
        if(Hash::check($credentials['password'], $vendor->password)) {
            return $vendor;
        }
    }

    public function getVendorProductType($id)
    {
        return Vendor::with('productTypes')->findOrFail($id);
    }
}
