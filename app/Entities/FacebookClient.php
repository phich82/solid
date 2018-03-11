<?php

namespace App\Entities;

use App\Contracts\SocialPostContract;


class FacebookClient implements SocialPostContract
{
    public function post()
    {
        FacebookPackageFake::post();
    }
}

class FacebookPackageFake
{
    public static function post()
    {
        echo "Post from Facebook<br>\n";
    }
}