<?php

namespace App\Entities;

use App\Contracts\SmsAdapter;


class Sms implements SmsAdapter
{
    public function send($subject, $template, $data)
    {
        SmsPackageFake::send($subject, $template, $data);
    }
}

class SmsPackageFake
{
    public static function send($subject, $template, $data)
    {
        echo "Fake sms sent.<br>\n";
    }
}