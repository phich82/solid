<?php

namespace App\Entities;

use App\Contracts\Notify;
use App\Contracts\MailAdapter;
use App\Contracts\SmsAdapter;

class MailAndSms implements Notify
{
    protected $mailer;
    protected $sms;

    /* inject DIs without Decorator pattern */
    public function __construct(MailAdapter $mailer, SmsAdapter $sms)
    {
        $this->mailer = $mailer;
        $this->sms = $sms;
    }

    public function send($subject, $template, $data)
    {
        $this->mailer->send($subject, $template, $data);
        $this->sms->send($subject, $template, $data);
    }
}