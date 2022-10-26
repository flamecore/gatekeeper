<?php
/*
 * Gatekeeper
 * Copyright (C) 2022 Christian Neff
 *
 * Permission to use, copy, modify, and/or distribute this software for
 * any purpose with or without fee is hereby granted, provided that the
 * above copyright notice and this permission notice appear in all copies.
 */

namespace Secondtruth\Gatekeeper\Check;

use Secondtruth\Gatekeeper\Visitor;

/**
 * Enforces adherence to protocol version claimed by user-agent.
 *
 * @author   Michael Hampton <bad.bots@ioerror.us>
 * @author   Christian Neff <christian.neff@gmail.com>
 */
class ProtocolCheck extends AbstractConfigurableCheck
{
    /**
     * {@inheritdoc}
     */
    public function checkVisitor(Visitor $visitor)
    {
        $headers = $visitor->getRequestHeaders();

        // We should never see 'Expect:' for HTTP/1.0 requests
        if ($headers->has('Expect') && stripos($headers->get('Expect'), '100-continue') !== false && !strcmp($visitor->getServerProtocol(), 'HTTP/1.0')) {
            return 'a0105122';
        }

        // Is it claiming to be HTTP/1.1? Then it shouldn't do HTTP/1.0 things.
        // Blocks some common corporate proxy servers in strict mode.
        if ($this->settings['strict'] && !strcmp($visitor->getServerProtocol(), 'HTTP/1.1')) {
            if ($headers->has('Pragma') && strpos($headers->get('Pragma'), 'no-cache') !== false && !$headers->has('Cache-Control')) {
                return '41feed15';
            }
        }

        return CheckInterface::RESULT_OKAY;
    }

    /**
     * {@inheritdoc}
     */
    protected function getSettingsDefaults()
    {
        return array(
            'strict' => false
        );
    }
}
