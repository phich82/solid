<?php

namespace App\Entities;

use App\Contracts\Notify;
use App\Contracts\MailAdapter;


class MailOnly implements Notify
{
    protected $mailer;

    /* inject DIs without Decorator pattern */
    public function __construct(MailAdapter $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send($subject, $template, $data)
    {
        $this->mailer->send($subject, $template, $data);
    }
}