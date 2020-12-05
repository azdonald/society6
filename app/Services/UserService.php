<?php


namespace App\Services;


use App\Exceptions\InvalidRequestException;
use App\Models\User;
use App\Repositories\interfaces\UserInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $userRepository;
    private $validationService;
    private $tokenService;

    /**
     * UserService constructor.
     * @param UserInterface $userRepository
     * @param ValidationService $validationService
     * @param TokenService $tokenService
     */
    public function __construct(UserInterface $userRepository, ValidationService $validationService, TokenService $tokenService)
    {
        $this->userRepository = $userRepository;
        $this->validationService = $validationService;
        $this->tokenService = $tokenService;
    }

    /**
     * @param array $userDetails
     * @return User
     * @throws InvalidRequestException
     */
    public function createUser(array $userDetails): User
    {
        try {
            $this->validationService->validate($userDetails, $this->userRules(), $this->validationMessage());
            $userDetails['password'] = Hash::make($userDetails['password']);
            return $this->userRepository->create($userDetails);
        }catch (InvalidRequestException $e) {
            throw new InvalidRequestException($e->getMessage());
        }
    }

    /**
     * @param array $credentials
     * @return string
     */
    public function login(array $credentials): string
    {
        $user = $this->userRepository->login($credentials);
        return $this->tokenService->generateToken($user->id, "user");
    }

    /**
     * @return string[]
     */
    private function userRules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ];
    }


    /**
     * @return string[]
     */
    private function validationMessage(): array
    {
        return $messages = [
            'required' => 'The :attribute field is required.',
            'email.unique' => 'We already have a user with :attribute registered',
        ];
    }
}
