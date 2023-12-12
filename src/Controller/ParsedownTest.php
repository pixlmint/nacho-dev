<?php

namespace App\Controller;

use Nacho\Controllers\AbstractController;
use Nacho\Models\HttpResponse;
use PixlMint\Parsedown\Parsedown;

class ParsedownTest extends AbstractController
{
    public function md(): HttpResponse {
        $parsedown = new Parsedown();
        $text = $parsedown->parse("$$\nölsakdjf$$");
        return new HttpResponse($text);
    }
}