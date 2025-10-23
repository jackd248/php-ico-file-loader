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

namespace KonradMichalik\PhpIcoFileLoader\Renderer;

use KonradMichalik\PhpIcoFileLoader\Model\IconImage;

/**
 * RendererInterface.
 *
 * @author Konrad Michalik <hej@konradmichalik.dev>
 * @license MIT
 */
interface RendererInterface
{
    /**
     * @param array<string, mixed>|null $opts
     */
    public function render(IconImage $img, ?array $opts = null): mixed;
}
