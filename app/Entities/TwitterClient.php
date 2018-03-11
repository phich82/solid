<?php

namespace App\Entities;

use App\Contracts\SocialUpdateContract;

class TwitterClient implements SocialUpdateContract
{
    public function tweet()
    {
        TwitterPackageFake::tweet();
    }
}

// class TwitterClient implements SocialPostContract
// {
//     public function post()
//     {
//         TwitterKackageFake::tweet();
//     }
// }

class TwitterPackageFake
{
    public static function tweet()
    {
        echo "Post from twitter<br>\n";
    }
}