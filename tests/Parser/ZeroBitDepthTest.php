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
use KonradMichalik\PhpIcoFileLoader\Renderer\GdRenderer;

/**
 * ZeroBitDepthTest.
 *
 * @author Konrad Michalik <hej@konradmichalik.dev>
 * @license MIT
 */
class ZeroBitDepthTest extends IcoTestCase
{
    public function testZeroBitDepthIcon()
    {
        // first, let's be sure our test file has got a zero for the bitDepth in the ICONDIRENTRY
        $data = file_get_contents('./tests/assets/zero-bit-depth-sample.ico');
        $hdr = unpack(
            'SReserved/SType/SCount/'.
            'Cwidth/Cheight/CcolorCount/Creserved/Splanes/SbitCount/LsizeInBytes/LfileOffset',
            $data,
        );
        $this->assertEquals(0, $hdr['bitCount']);
        $this->assertEquals(1384, $hdr['sizeInBytes']);

        // run it through the parser and verify looks sane...
        $icon = $this->parseIcon('zero-bit-depth-sample.ico');
        $image = $icon[0];
        $this->assertEquals(8, $image->bitCount);
        $this->assertSame('16x16 pixel BMP @ 8 bits/pixel', $image->getDescription());

        // render on green background to better show where transparency should be
        $renderer = new GdRenderer();
        $im = $renderer->render($image, ['background' => '#00ff00']);
        $this->assertImageLooksLike('zero-bit-depth-expected.png', $im);
    }
}
