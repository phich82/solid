<?php

namespace App\Services;

use App\Repositories\PromotionRepositoryContract;

class PromotionService implements PromotionServiceContract
{
    
    protected $repository;

    public function __construct(PromotionRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function paginate()
    {
        return $this->repository->paginate();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function store($id)
    {
        return $this->repository->store($id);
    }

    public function update($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}