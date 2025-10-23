<div align="center">

# Php Ico File Loeader

[![Coverage](https://img.shields.io/coverallsCoverage/github/jackd248/php-ico-file-loader?logo=coveralls)](https://coveralls.io/github/jackd248/php-ico-file-loader)
[![CGL](https://img.shields.io/github/actions/workflow/status/jackd248/php-ico-file-loader/cgl.yml?label=cgl&logo=github)](https://github.com/jackd248/php-ico-file-loader/actions/workflows/cgl.yml)
[![Tests](https://img.shields.io/github/actions/workflow/status/jackd248/php-ico-file-loader/tests.yml?label=tests&logo=github)](https://github.com/jackd248/php-ico-file-loader/actions/workflows/tests.yml)
[![Supported PHP Versions](https://img.shields.io/packagist/dependency-v/konradmichalik/php-ico-file-loader/php?logo=php)](https://packagist.org/packages/konradmichalik/php-ico-file-loader)

</div>

This package provides a means to load and convert .ico files in a PHP application. 
It has no dependencies apart from [gd](http://php.net/manual/en/book.image.php) 
for rendering.

The package has unit tests which verify support for 1bit, 4bit, 8bit, 24bit and 32bit
.ico files, and the newer form of .ico files which can included embedded PNG files.

## Installation

```bash
composer require konradmichalik/php-ico-file-loader
```

## Usage

```php
$loader = new KonradMichalik\PhpIcoFileLoeader\Parser\IcoFileService;
$im = $loader->extractIcon('/path/to/icon.ico', 32, 32);

imagepng($im, '/path/to/output.png');
```

## 💛 Acknowledgements

This project is a fork and further development of [`lordelph/icofileloader`](https://github.com/lordelph/icofileloader).

## 🧑‍💻 Contributing

Please have a look at [`CONTRIBUTING.md`](CONTRIBUTING.md).

## ⭐ License

This project is licensed under [MIT](LICENSE.md).
