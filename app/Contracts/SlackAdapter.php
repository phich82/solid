<?php

namespace App\Contracts;

interface SlackAdapter
{
    public function send($subject, $template, $data);
}