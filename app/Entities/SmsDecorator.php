<?php

namespace App\Entities;

use App\Contracts\Notify;
use App\Contracts\SmsAdapter;

class SmsDecorator implements Notify
{
    protected $notifier;
    protected $sms;

    /* inject DIs with Decorator pattern */
    public function __construct(Notify $notifier, SmsAdapter $sms)
    {
        $this->notifier = $notifier;
        $this->sms = $sms;
    }

    public function send($subject, $template, $data)
    {
        $this->notifier->send($subject, $template, $data);
        $this->sms->send($subject, $template, $data);
    }
}