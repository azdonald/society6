<?php


namespace App\Repositories;


use App\Exceptions\InvalidRequestException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository implements interfaces\UserInterface
{

    /**
     * @param array $userDetails
     * @return User
     */
    public function create(array $userDetails):User
    {
        return User::create($userDetails);
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function getById(int $id):?User
    {
        return User::findOrFail($id);
    }

    /**
     * @param array $credentials
     * @return User
     * @throws InvalidRequestException
     */
    public function login(array $credentials):User
    {
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            throw new InvalidRequestException("Email or Password is wrong");
        }
        if(Hash::check($credentials['password'], $user->password)) {
            return $user;
        }
    }
}
