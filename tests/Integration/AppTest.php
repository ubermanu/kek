<?php

namespace Kek\Tests\Integration;

class AppTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers
     * @throws \Throwable
     */
    public function testGetRoute()
    {
        $app = new \Kek\App();
        $app->get('/', fn() => 'Hello World');
        $req = new \Kek\Request('GET', '/');

        $this->assertEquals('Hello World', $app->execute($req)->getBody());
    }
}
