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

use KonradMichalik\PhpIcoFileLoader\Renderer\GdRenderer;
use KonradMichalik\PhpIcoFileLoader\Tests\IcoTestCase;

/**
 * LoadPngAsIcoTest.
 *
 * @author Konrad Michalik <hej@konradmichalik.dev>
 * @license MIT
 */
final class LoadPngAsIcoTest extends IcoTestCase
{
    public function testLoadPngAsIcoTest(): void
    {
        // first, let's be sure our test file is a PNG
        $signature = unpack('LFourCC', file_get_contents('./tests/assets/png-as-ico-sample.ico'));
        $this->assertEquals(0x474E5089, $signature['FourCC']);

        // run it through the parser and verify looks sane...
        $icon = $this->parseIcon('png-as-ico-sample.ico');
        $image = $icon[0];
        $this->assertSame('16x16 pixel PNG @ 8 bits/pixel', $image->getDescription());

        // render on green background to better show where transparency should be
        $renderer = new GdRenderer();
        $im = $renderer->render($image, ['background' => '#00ff00']);
        $this->assertImageLooksLike('png-as-ico-expected.png', $im);
    }
}
