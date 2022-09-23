<?php

namespace Kek\Tests\Unit\Template;

class PhpFileTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers
     * @return void
     * @throws \Kek\Exception
     */
    public function testRendersProperly(): void
    {
        $filename = dirname(__FILE__) . '/_files/php-template.phtml';
        $template = new \Kek\Template\PhpFile($filename);

        $this->assertEquals("<h1>Hello World</h1>\n", $template->render(['someVar' => 'World']));
    }
}
