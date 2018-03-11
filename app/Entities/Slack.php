<?php

namespace App\Entities;

use App\Contracts\SlackAdapter;


class Slack implements SlackAdapter
{
    public function send($subject, $template, $data)
    {
        SlackPackageFake::send($subject, $template, $data);
    }
}

class SlackPackageFake
{
    public static function send($subject, $template, $data)
    {
        echo "Fake slack sent.<br>\n";
    }
}