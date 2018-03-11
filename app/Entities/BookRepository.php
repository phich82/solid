<?php

namespace App\Entities;

use App\Entities\BookFake;
use App\Contracts\BookRepositoryContract;


class BookRepository implements BookRepositoryContract
{
    protected $model;

    public function __construct(BookFake $model)
    {
        $this->model = $model;
    }

    public function paginate($quantity)
    {
        return $this->model->paginate($quantity);
    }

    public function save($data)
    {
        return $this->model->save($data);
    }
}