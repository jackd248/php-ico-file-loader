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

namespace KonradMichalik\PhpIcoFileLoader\Tests\Parser;

use KonradMichalik\PhpIcoFileLoader\IcoTestCase;
use KonradMichalik\PhpIcoFileLoader\Model\Icon;
use KonradMichalik\PhpIcoFileLoader\Parser\IcoParser;

/**
 * IcoParserTest.
 *
 * @author Konrad Michalik <hej@konradmichalik.dev>
 * @license MIT
 */
class IcoParserTest extends IcoTestCase
{
    public function test32bitIcon()
    {
        $iconFile = './tests/assets/32bit-16px-32px-sample.ico';
        $data = file_get_contents($iconFile);

        $parser = new IcoParser();
        // check the parser can tell an .ico from other garbage
        $this->assertFalse($parser->isSupportedBinaryString('garbage'));
        $this->assertTrue($parser->isSupportedBinaryString($data));

        // and away we go...
        $icon = $parser->parse($data);
        $this->assertInstanceOf(Icon::class, $icon);
        $this->assertTrue($icon[0]->isBmp());

        // we expect 2 images in this sample
        $this->assertCount(2, $icon);
        $this->assertSame('16x16 pixel BMP @ 32 bits/pixel', $icon[0]->getDescription());
        $this->assertSame('32x32 pixel BMP @ 32 bits/pixel', $icon[1]->getDescription());
        $this->assertNotInstanceOf(\KonradMichalik\PhpIcoFileLoader\Model\IconImage::class, $icon[2]);
    }

    public function test24bitIcon()
    {
        $parser = new IcoParser();
        $icon = $parser->parse(file_get_contents('./tests/assets/24bit-32px-sample.ico'));
        $this->assertCount(1, $icon);
        $this->assertSame('32x32 pixel BMP @ 24 bits/pixel', $icon[0]->getDescription());
    }

    public function test8bitIcon()
    {
        $parser = new IcoParser();
        $icon = $parser->parse(file_get_contents('./tests/assets/8bit-48px-32px-16px-sample.ico'));
        $this->assertCount(6, $icon);
        $this->assertSame('32x32 pixel BMP @ 4 bits/pixel', $icon[0]->getDescription());
        $this->assertSame('16x16 pixel BMP @ 4 bits/pixel', $icon[1]->getDescription());
        $this->assertSame('32x32 pixel BMP @ 8 bits/pixel', $icon[2]->getDescription());
        $this->assertSame('16x16 pixel BMP @ 8 bits/pixel', $icon[3]->getDescription());
        $this->assertSame('48x48 pixel BMP @ 8 bits/pixel', $icon[4]->getDescription());
        $this->assertSame('48x48 pixel BMP @ 4 bits/pixel', $icon[5]->getDescription());
    }

    public function test4bitIcon()
    {
        $parser = new IcoParser();
        $icon = $parser->parse(file_get_contents('./tests/assets/4bit-32px-16px-sample.ico'));
        $this->assertCount(2, $icon);
        $this->assertSame('32x32 pixel BMP @ 4 bits/pixel', $icon[0]->getDescription());
        $this->assertSame('16x16 pixel BMP @ 4 bits/pixel', $icon[1]->getDescription());
    }

    public function test1bitIcon()
    {
        $parser = new IcoParser();
        $icon = $parser->parse(file_get_contents('./tests/assets/1bit-32px-sample.ico'));
        $this->assertCount(1, $icon);
        $this->assertSame('32x32 pixel BMP @ 1 bits/pixel', $icon[0]->getDescription());
    }

    public function testPngIcon()
    {
        $parser = new IcoParser();
        $icon = $parser->parse(file_get_contents('./tests/assets/32bit-png-sample.ico'));
        $this->assertCount(12, $icon);
        $this->assertSame('16x16 pixel BMP @ 4 bits/pixel', $icon[0]->getDescription());
        $this->assertSame('16x16 pixel BMP @ 8 bits/pixel', $icon[1]->getDescription());
        $this->assertSame('32x32 pixel BMP @ 4 bits/pixel', $icon[2]->getDescription());
        $this->assertSame('32x32 pixel BMP @ 8 bits/pixel', $icon[3]->getDescription());
        $this->assertSame('48x48 pixel BMP @ 4 bits/pixel', $icon[4]->getDescription());
        $this->assertSame('48x48 pixel BMP @ 8 bits/pixel', $icon[5]->getDescription());
        $this->assertSame('256x256 pixel PNG @ 4 bits/pixel', $icon[6]->getDescription());
        $this->assertSame('256x256 pixel PNG @ 8 bits/pixel', $icon[7]->getDescription());
        $this->assertSame('16x16 pixel BMP @ 32 bits/pixel', $icon[8]->getDescription());
        $this->assertSame('32x32 pixel BMP @ 32 bits/pixel', $icon[9]->getDescription());
        $this->assertSame('48x48 pixel BMP @ 32 bits/pixel', $icon[10]->getDescription());
        $this->assertSame('256x256 pixel PNG @ 32 bits/pixel', $icon[11]->getDescription());
    }

    public function testEmptyIcon()
    {
        $parser = new IcoParser();
        $icon = $parser->parse(file_get_contents('./tests/assets/empty.ico'));
        $this->assertCount(0, $icon);
    }
}
