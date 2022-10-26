<?php
/*
 * Gatekeeper
 * Copyright (C) 2022 Christian Neff
 *
 * Permission to use, copy, modify, and/or distribute this software for
 * any purpose with or without fee is hereby granted, provided that the
 * above copyright notice and this permission notice appear in all copies.
 */

namespace Secondtruth\Gatekeeper\Tests\Check;

use Secondtruth\Gatekeeper\Check\CheckInterface;
use Secondtruth\Gatekeeper\Check\UrlCheck;

/**
 * Test class for UrlCheck
 */
class UrlCheckTest extends CheckTestCase
{
    protected function setUp(): void
    {
        $this->check = new UrlCheck();
    }

    public function testCheckPositive()
    {
        // Check #1
        $result = $this->runTestCheck('/?;DECLARE%20@');
        $this->assertEquals('dfd9b1ad', $result);

        // Check #2
        $result = $this->runTestCheck('/?0x31303235343830303536');
        $this->assertEquals('96c0bd29', $result);
    }

    public function testCheckNegative()
    {
        $result = $this->runTestCheck();

        $this->assertEquals(CheckInterface::RESULT_OKAY, $result);
    }
}
