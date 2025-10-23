<?php

declare(strict_types=1);

/*
 * This file is part of the "php-ico-file-loader" Composer package.
 *
 * (c) Konrad Michalik <hej@konradmichalik.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KonradMichalik\PhpIcoFileLoader\Parser;

use KonradMichalik\PhpIcoFileLoader\Model\Icon;

/**
 * ParserInterface.
 *
 * @author Konrad Michalik <hej@konradmichalik.dev>
 * @license MIT
 */
interface ParserInterface
{
    public function isSupportedBinaryString(string $data): bool;

    public function parse(string $data): Icon;
}
