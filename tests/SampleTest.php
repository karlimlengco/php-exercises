<?php

require_once('./testing/Hasher.php');

use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    public function testNumberIsOne()
    {
        $hasher = new Hasher;

        $this->assertEquals(32, strlen($hasher->hash('md5', 'nice')));
        $this->assertEquals(40, strlen($hasher->hash('sha1', 'nice')));
        $this->assertEquals(64, strlen($hasher->hash('sha256', 'nice')));
    }
}
?>