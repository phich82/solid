<?php

namespace App\Entities;

class BookFake
{
    public function paginate($quantity)
    {
        $result = ['error' => 'Invalid input'];
        if (is_int($quantity) && $quantity > 0) {
            $result = range(0, $quantity);
        }
        echo "Data from BookFake model ".json_encode($result)."<br>\n";
        return $result;
    }

    public function save($data)
    {
        echo "Data saved ".(is_array($data) && !empty($data) ? json_encode($data)." " : "")."successfully by BookFake model<br>\n";
        return true;
    }
}