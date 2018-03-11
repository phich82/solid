<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\BookRepositoryContract;

class BookController extends Controller
{
    protected $repository;

    public function __construct(BookRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $books = $this->repository->paginate(10);
        return $books;
    }

    public function store(Request $request)
    {
        $data = ['name' => 'Jhp Phich', 'age' => 30];
        if (!empty($request->all())) $data = $request->all();
        $this->repository->save($data);
    }
}
