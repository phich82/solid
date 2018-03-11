<?php

namespace App\Contracts;

interface BookRepositoryContract
{
    public function paginate($quantity);
    public function save($data);
}