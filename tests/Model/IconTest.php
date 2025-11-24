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

namespace KonradMichalik\PhpIcoFileLoader\Tests\Model;

use InvalidArgumentException;
use KonradMichalik\PhpIcoFileLoader\Model\{Icon, IconImage};
use KonradMichalik\PhpIcoFileLoader\Tests\IcoTestCase;

/**
 * IconTest.
 *
 * @author Konrad Michalik <hej@konradmichalik.dev>
 * @license MIT
 */
final class IconTest extends IcoTestCase
{
    public function testArrayInterface()
    {
        $icon = new Icon();
        $icon[] = new IconImage([]);
        $this->assertArrayHasKey(0, $icon);
        $this->assertArrayNotHasKey(1, $icon);

        unset($icon[0]);
        $this->assertArrayNotHasKey(0, $icon);

        $icon[0] = new IconImage([]);
        $this->assertArrayHasKey(0, $icon);

        $this->assertCount(1, $icon);
    }

    public function testInvalidAdd()
    {
        $this->expectException(InvalidArgumentException::class);
        $icon = new Icon();
        $icon[] = 'foo'; // @phpstan-ignore-line offsetAssign.valueType
    }
}
