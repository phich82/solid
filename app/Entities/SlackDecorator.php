<?php

namespace App\Entities;

use App\Contracts\Notify;
use App\Contracts\SlackAdapter;

class SlackDecorator implements Notify
{
    protected $notifier;
    protected $slack;

    /* inject DIs with Decorator pattern */
    public function __construct(Notify $notifier, SlackAdapter $slack)
    {
        $this->notifier = $notifier;
        $this->slack = $slack;
    }

    public function send($subject, $template, $data)
    {
        $this->notifier->send($subject, $template, $data);
        $this->slack->send($subject, $template, $data);
    }
}