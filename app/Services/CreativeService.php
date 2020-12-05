<?php


namespace App\Services;


use App\Models\Creative;
use App\Repositories\interfaces\CreativeInterface;

class CreativeService
{
    private $creativeRepository;
    private $validationService;

    /**
     * CreativeService constructor.
     * @param CreativeInterface $creativeRepository
     * @param ValidationService $validationService
     */
    public function __construct(CreativeInterface $creativeRepository, ValidationService $validationService)
    {
        $this->creativeRepository = $creativeRepository;
        $this->validationService = $validationService;
    }

    /**
     * @param array $data
     * @return Creative
     * @throws \App\Exceptions\InvalidRequestException
     */
    public function add(array $data):Creative
    {
        try {
            $this->validationService->validate($data, $this->creativeRules(), $this->validationMessage());
            return $this->creativeRepository->create($data);
        }catch (InvalidRequestException $e) {
            throw new InvalidRequestException($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function getAllCreatives()
    {
        return $this->creativeRepository->getAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCreative($id)
    {
        return $this->creativeRepository->getById($id);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $creative = $this->creativeRepository->getById($id);
        return $this->creativeRepository->update($creative, $data);
    }

    /**
     * @return string[]
     */
    private function creativeRules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    private function validationMessage(): array
    {
        return $messages = [
            'required' => 'The :attribute field is required.'
        ];
    }
}
