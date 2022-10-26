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
 * Class AbstractCheck
 *
 * @author   Christian Neff <christian.neff@gmail.com>
 */
abstract class AbstractCheck implements CheckInterface
{
    /**
     * {@inheritdoc}
     */
    public function isResponsibleFor(Visitor $visitor)
    {
        return true;
    }
}
