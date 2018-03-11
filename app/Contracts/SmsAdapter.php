<?php

namespace App\Contracts;

interface SmsAdapter
{
    public function send($subject, $template, $data);
}