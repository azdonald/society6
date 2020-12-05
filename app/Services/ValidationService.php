<?php


namespace App\Services;


use App\Exceptions\InvalidRequestException;
use Illuminate\Support\Facades\Validator;

class ValidationService
{
    /**
     * @param array $data
     * @param array $rules
     * @param array $errorMessages
     * @throws InvalidRequestException
     */
    public function validate(array $data, array $rules, array $errorMessages)
    {
        $validator = Validator::make($data, $rules, $errorMessages);
        if ($validator->fails()) {
            throw new InvalidRequestException(implode(",",$validator->messages()->all()));
        }
    }
}
