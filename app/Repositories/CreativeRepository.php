<?php


namespace App\Repositories;


use App\Models\Creative;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CreativeRepository
 * @package App\Repositories
 */
class CreativeRepository implements interfaces\CreativeInterface
{

    /**
     * @param array $data
     * @return Creative
     */
    public function create(array $data):Creative
    {
        return Creative::create($data);
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        Creative::findOrFail($id)->delete();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAll()
    {
        return Creative::with('owner')->get();
    }

    /**
     * @param int $id
     * @return Creative|null
     */
    public function getById(int $id):?Creative
    {
        return Creative::with('owner')->findOrFail($id);
    }

    /**
     * @param Creative $creative
     * @param array $creativeDetails
     * @return Creative
     */
    public function update(Creative $creative, array $creativeDetails):Creative
    {
        $creative->update($creativeDetails);
        return $creative;
    }
}
