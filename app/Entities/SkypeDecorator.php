<?php

namespace App\Entities;

use App\Contracts\Notify;
use App\Contracts\SkypeAdapter;

class SkypeDecorator implements Notify
{
    protected $notifier;
    protected $skype;

    /* inject DIs with Decorator pattern */
    public function __construct(Notify $notifier, SkypeAdapter $skype)
    {
        $this->notifier = $notifier;
        $this->skype = $skype;
    }

    public function send($subject, $template, $data)
    {
        $this->notifier->send($subject, $template, $data);
        $this->skype->send($subject, $template, $data);
    }
}