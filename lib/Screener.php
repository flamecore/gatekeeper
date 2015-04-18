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

namespace FlameCore\Gatekeeper;

use FlameCore\Gatekeeper\Check\CheckInterface;

/**
 * Class Screener
 *
 * @author   Christian Neff <christian.neff@gmail.com>
 */
class Screener implements ScreenerInterface
{
    /**
     * @var \FlameCore\Gatekeeper\Check\CheckInterface[]
     */
    protected $checks = array();

    /**
     * @var array
     */
    protected $whitelist = array();

    /**
     * {@inheritdoc}
     */
    public function screenVisitor(Visitor $visitor)
    {
        if (Utils::matchCIDR($visitor->getIP(), $this->whitelist)) {
            return false;
        }

        foreach ($this->checks as $check) {
            $result = $check->checkVisitor($visitor);

            if ($result !== false) {
                return $result;
            }
        }

        return false;
    }

    /**
     * @return \FlameCore\Gatekeeper\Check\CheckInterface[]
     */
    public function getChecks()
    {
        return $this->checks;
    }

    /**
     * @param \FlameCore\Gatekeeper\Check\CheckInterface $check
     */
    public function addCheck(CheckInterface $check)
    {
        $this->checks[] = $check;
    }

    /**
     * @return array
     */
    public function getWhitelist()
    {
        return $this->whitelist;
    }

    /**
     * @param array $whitelist
     */
    public function setWhitelist(array $whitelist)
    {
        $this->whitelist = array_filter($whitelist);
    }

    /**
     * @param string $file
     */
    public function loadWhitelist($file)
    {
        $whitelist = file($file, FILE_SKIP_EMPTY_LINES);

        $this->setWhitelist($whitelist);
    }
}