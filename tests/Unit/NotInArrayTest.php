<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class NotInArrayTest extends TestCase
{
    public function testAssertValueNotInArray(): void
    {
        $fruits = ['bananas', 'apples', 'oranges', 'grapes', 'watermelon'];

        $this->assertFalse(in_array('kiwi', $fruits));
        $this->assertTrue(not_in_array('kiwi', $fruits));

    }
}
