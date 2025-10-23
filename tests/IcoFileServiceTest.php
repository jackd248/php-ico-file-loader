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

namespace KonradMichalik\PhpIcoFileLoader;

use DomainException;
use InvalidArgumentException;

use function count;

/**
 * IcoFileServiceTest.
 *
 * @author Konrad Michalik <hej@konradmichalik.dev>
 * @license MIT
 */
class IcoFileServiceTest extends IcoTestCase
{
    public function testExtract()
    {
        $service = new IcoFileService();
        $im = $service->extractIcon('./tests/assets/32bit-16px-32px-sample.ico', 64, 64);
        $this->assertImageLooksLike('32bit-64px-resize-expected.png', $im);
    }

    public function testExtractEmpty()
    {
        $this->expectException(DomainException::class);

        $service = new IcoFileService();
        $im = $service->extractIcon('./tests/assets/empty.ico', 64, 64);
    }

    public function testFromWithData()
    {
        $service = new IcoFileService();
        $data = file_get_contents('./tests/assets/32bit-16px-32px-sample.ico');
        $icon = $service->from($data);
        $this->assertNotNull($icon);

        $icon = $service->fromString($data);
        $this->assertNotNull($icon);
    }

    public function testFromWithFile()
    {
        $service = new IcoFileService();
        $icon = $service->from('./tests/assets/32bit-16px-32px-sample.ico');
        $this->assertNotNull($icon);
    }

    public function testInvalidFrom()
    {
        $this->expectException(InvalidArgumentException::class);
        $service = new IcoFileService();
        $service->from('not an icon');
    }

    public function testInvalidFromString()
    {
        $this->expectException(InvalidArgumentException::class);
        $service = new IcoFileService();
        $service->fromString('not an icon');
    }

    public function testInvalidFromFile()
    {
        $this->expectException(InvalidArgumentException::class);
        $service = new IcoFileService();
        $service->fromFile('not a file');
    }

    public function testIterateExample()
    {
        $service = new IcoFileService();
        $icon = $service->fromFile('./tests/assets/32bit-16px-32px-sample.ico');

        $count = 0;
        foreach ($icon as $image) {
            $im = $service->renderImage($image);
            $this->assertIsObject($im);
            ++$count;
        }
        $this->assertSame(count($icon), $count);
    }
}
