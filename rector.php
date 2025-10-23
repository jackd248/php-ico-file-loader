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

use EliasHaeussler\RectorConfig\Config\Config;
use Rector\Config\RectorConfig;
use Rector\PHPUnit\PHPUnit60\Rector\ClassMethod\AddDoesNotPerformAssertionToNonAssertingTestRector;
use Rector\ValueObject\PhpVersion;

return static function (RectorConfig $rectorConfig): void {
    Config::create($rectorConfig, PhpVersion::PHP_81)
        ->in(
            __DIR__.'/src',
            __DIR__.'/tests',
        )
        ->withSymfony()
        ->withPHPUnit()
        ->skip(AddDoesNotPerformAssertionToNonAssertingTestRector::class)
        ->apply()
    ;
};
