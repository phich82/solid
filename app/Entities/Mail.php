<?php

namespace App\Entities;

use App\Contracts\MailAdapter;

class Mail implements MailAdapter
{
    public function send($subject, $template, $data)
	{
        MailPackageFake::send($subject, $template, $data);       
	}
}

class MailPackageFake
{
    public static function send($subject, $template, $data)
    {
        echo "Fake email sent.<br>\n";
        // Mail::send($template, ['user' => $data], function ($m) use ($data) {
        //     $m->from('hello@app.com', 'Your Application');
        //     $m->to($data->email, $data->name)->subject($subject);
        // });
    }
}