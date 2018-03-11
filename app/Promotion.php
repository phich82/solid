<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['promotionName','planStartDate','amount', 'mileType', 'deleteFlag'];
}
