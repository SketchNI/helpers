<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class NotNullTest extends TestCase
{
    public function testAssertValueNotNull(): void
    {
        $null_value = null;
        $unnull_value = "this is a string";

        $this->assertTrue(not_null($unnull_value));
        $this->assertTrue(is_null($null_value));

    }
}
