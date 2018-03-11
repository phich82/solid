<?php

namespace App\Entities;

use Illuminate\Support\Facades\Redis as Cache;
//use Illuminate\Cache\Repository as Cache; // laravel default cache
use App\Contracts\BookRepositoryContract;


class BookRepositoryCache implements BookRepositoryContract
{
    protected $repository;
    protected $cache;

    public function __construct(BookRepositoryContract $repository, Cache $cache)
    {
        $this->repository = $repository;
        $this->cache = $cache;
    }

    public function paginate($quantity)
    {
        $result = $this->cache::get('books.paginate');   
        if ($result == 'null') {
            $result = $this->repository->paginate($quantity);     
            $result = json_encode($result);
            $this->cache::set('books.paginate', $result);
        }     
        return json_decode($result, true);

        // return $this->cache->tags('books')->rememberForever('books.paginate', function () use ($quantity) {
        //     return $this->repository->paginate($quantity);
        // });
    }

    public function save($data)
    {    
        echo "Data from cache: ".$this->cache::get('books.paginate')."<br>\n";
        if ($this->repository->save($data)) {
            $this->cache::set('insertedData', json_encode($data));
        }
    }
}