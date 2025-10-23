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

namespace KonradMichalik\PhpIcoFileLoader\Model;

use ArrayAccess;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;
use Traversable;

use function count;

/**
 * Icon.
 *
 * @author Konrad Michalik <hej@konradmichalik.dev>
 * @license MIT
 *
 * @implements ArrayAccess<int|null, IconImage>
 * @implements IteratorAggregate<int, IconImage>
 */
class Icon implements ArrayAccess, Countable, IteratorAggregate
{
    /**
     * @var array<int, IconImage>
     */
    private array $images = [];

    public function findBestForSize(int $w, int $h): ?IconImage
    {
        $bestBitCount = 0;
        $best = null;
        foreach ($this->images as $image) {
            if ($image->width === $w && $image->height === $h && ($image->bitCount > $bestBitCount)) {
                $bestBitCount = $image->bitCount;
                $best = $image;
            }
        }

        return $best;
    }

    public function findBest(): ?IconImage
    {
        $bestBitCount = 0;
        $bestWidth = 0;
        $best = null;
        foreach ($this->images as $image) {
            if (($image->width > $bestWidth)
                || (($image->width === $bestWidth) && ($image->bitCount > $bestBitCount))
            ) {
                $bestWidth = $image->width;
                $bestBitCount = $image->bitCount;
                $best = $image;
            }
        }

        return $best;
    }

    public function count(): int
    {
        return count($this->images);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        // Runtime check needed for proper ArrayAccess behavior despite PHPDoc types
        if (!$value instanceof IconImage) { // @phpstan-ignore-line  instanceof.alwaysTru
            throw new InvalidArgumentException('Value must be an instance of IconImage');
        }

        if (null === $offset) {
            $this->images[] = $value;
        } else {
            $this->images[$offset] = $value;
        }
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->images[$offset]);
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->images[$offset]);
    }

    public function offsetGet(mixed $offset): ?IconImage
    {
        return $this->images[$offset] ?? null;
    }

    /**
     * @return Traversable<int, IconImage>
     */
    public function getIterator(): Traversable
    {
        yield from $this->images;
    }
}
