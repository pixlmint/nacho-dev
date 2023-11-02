<?php

namespace App\Controller;

use Nacho\Controllers\AbstractController;

class Debug extends AbstractController
{
    public function info(): string
    {
        return phpinfo();
    }
}