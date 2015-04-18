<?php
/**
 * Gatekeeper Library
 * Copyright (C) 2015 IceFlame.net
 *
 * Permission to use, copy, modify, and/or distribute this software for
 * any purpose with or without fee is hereby granted, provided that the
 * above copyright notice and this permission notice appear in all copies.
 *
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
 * WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE
 * FOR ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY
 * DAMAGES WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER
 * IN AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING
 * OUT OF OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
 *
 * @package  FlameCore\Gatekeeper
 * @version  0.1-dev
 * @link     http://www.flamecore.org
 * @license  ISC License <http://opensource.org/licenses/ISC>
 */

namespace FlameCore\Gatekeeper\Storage;

use FlameCore\Gatekeeper\Visitor;

/**
 * Interface StorageInterface
 *
 * @author   Christian Neff <christian.neff@gmail.com>
 */
interface StorageInterface
{
    /**
     * @param \FlameCore\Gatekeeper\Visitor $visitor
     * @param string $result
     * @return bool
     */
    public function insert(Visitor $visitor, $result);

    /**
     * @return bool
     */
    public function count();

    /**
     * @return bool
     */
    public function cleanup();

    /**
     * @return bool
     */
    public function optimize();
}