<?php

namespace App\Entities;

use App\Entities\Golden;
use App\Entities\Silver;
use App\Entities\Bronze;
use App\Entities\Platinum;

class UserTypeFactory
{
    public static function make($type)
    {
        switch ($type) {
            case 'platinum':
                return new Platinum;
                break;
            case 'golden':
                return new Golden;
                break;
            case 'silver':
                return new Silver;
                break;
            case 'bronze':
                return new Bronze;
                break;
        }
    }
}