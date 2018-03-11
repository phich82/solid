<?php

namespace App\Entities;

use App\Contracts\Notify;
use App\Contracts\MailAdapter;
use App\Contracts\SmsAdapter;
use App\Contracts\SlackAdapter;

class MailAndSmsAndSlack implements Notify
{
    protected $mailer;
    protected $sms;
    protected $slack;

    /* inject DIs without Decorator pattern */
    public function __construct(MailAdapter $mailer, SmsAdapter $sms, SlackAdapter $slack)
    {
        $this->mailer = $mailer;
        $this->sms = $sms;
        $this->slack = $slack;
    }

    public function send($subject, $template, $data)
    {
        $this->mailer->send($subject, $template, $data);
        $this->sms->send($subject, $template, $data);
        $this->slack->send($subject, $template, $data);
    }
}