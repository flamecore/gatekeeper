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
use Secondtruth\Gatekeeper\Check\HeadersCheck;

/**
 * Test class for HeadersCheck
 */
class HeadersCheckTest extends CheckTestCase
{
    protected function setUp(): void
    {
        $this->check = new HeadersCheck([
            'strict' => true
        ]);
    }

    public function testCheckConnectionHeader()
    {
        // Check #1
        $result = $this->runTestCheck(null, null, [], [], [], ['HTTP_CONNECTION' => 'Keep-Alive, Close']);
        $this->assertEquals('a52f0448', $result);

        // Check #2
        $result = $this->runTestCheck(null, null, [], [], [], ['HTTP_CONNECTION' => 'Close, Close']);
        $this->assertEquals('a52f0448', $result);

        // Check #3
        $result = $this->runTestCheck(null, null, [], [], [], ['HTTP_CONNECTION' => 'Keep-Alive, Keep-Alive']);
        $this->assertEquals('a52f0448', $result);

        // Check #4
        $result = $this->runTestCheck(null, null, [], [], [], ['HTTP_CONNECTION' => 'Keep-Alive: xyz']);
        $this->assertEquals('b0924802', $result);
    }

    public function testCheckRefererHeader()
    {
        // Check #1
        $result = $this->runTestCheck(null, null, [], [], [], ['HTTP_REFERER' => '']);
        $this->assertEquals('69920ee5', $result);

        // Check #2
        $result = $this->runTestCheck(null, null, [], [], [], ['HTTP_REFERER' => '/index.html']);
        $this->assertEquals('45b35e30', $result);
    }

    public function testCheckNegative()
    {
        $result = $this->runTestCheck();

        $this->assertEquals(CheckInterface::RESULT_OKAY, $result);
    }
}
