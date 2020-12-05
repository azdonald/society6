<?php


namespace App\Repositories\interfaces;

/**
 * Interface UserInterface
 * @package App\Repositories\interfaces
 */
interface UserInterface
{
    public function create(array $userDetails);
    public function getById(int $id);
    public function login(array $credentials);
}
