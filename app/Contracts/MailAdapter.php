<?php

namespace App\Contracts;

interface MailAdapter
{
    public function send($subject, $template, $data);
}