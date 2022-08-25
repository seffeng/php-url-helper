<?php

use PHPUnit\Framework\TestCase;
use Seffeng\UrlHelper\Url;

class UrlTest extends TestCase
{
    public function testParseUrl()
    {
        $url = 'https://www.1kmi.com/view/2.php';
        print_r(Url::parseUrl($url));
    }
}