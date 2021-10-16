<?php

final class PhpFile extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers
     * @throws \Kek\Exception
     */
    public function testRendersProperly()
    {
        $filename = dirname(__FILE__) . '/files/php-template.phtml';
        $template = new \Kek\Template\PhpFile($filename);

        $this->assertEquals('<h1>Hello World</h1>', $template->render(['someVar' => 'World']));
    }
}
