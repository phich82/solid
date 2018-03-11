<?php

namespace App\Contracts;

interface Notify
{
    public function send($subject, $template, $data);
}