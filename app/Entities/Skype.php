<?php

namespace App\Entities;

use App\Contracts\SkypeAdapter;


class Skype implements SkypeAdapter
{
    public function send($subject, $template, $data)
    {
        SkypePackageFake::send($subject, $template, $data);
    }
}

class SkypePackageFake
{
    public static function send($subject, $template, $data)
    {
        echo "Fake skype sent.<br>\n";
    }
}