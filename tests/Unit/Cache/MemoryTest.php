<?php

namespace Kek\Tests\Unit\Cache;

class MemoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers
     * @return void
     */
    public function testCanSaveAndRemove(): void
    {
        $cache = new \Kek\Cache\Memory();
        $id = '1634393170';

        $cache->save($id, 'can-save-?');
        $this->assertEquals('can-save-?', $cache->load($id));

        $cache->remove($id);
        $this->assertEquals(null, $cache->load($id));
    }

    /**
     * @covers
     * @return void
     */
    public function testCanExpire():void
    {
        $cache = new \Kek\Cache\Memory();
        $id = '1634393446';

        $cache->save($id, 'can-expire-?', 1);
        $this->assertEquals('can-expire-?', $cache->load($id));

        sleep(2);
        $this->assertEquals(null, $cache->load($id));
    }
}
