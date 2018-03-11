<?php

namespace App\Contracts;

interface SkypeAdapter
{
    public function send($subject, $template, $data);
}