<?php


namespace App\Repositories\interfaces;


use App\Models\Creative;

/**
 * Interface CreativeInterface
 * @package App\Repositories\interfaces
 */
interface CreativeInterface
{
    public function create(array $creativeDetails);
    public function update(Creative $creative, array $creativeDetails);
    public function getById(int $id);
    public function getAll();
}
