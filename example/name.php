<?php

require __DIR__ . '/../vendor/autoload.php';

use Filewizard\UploadWizard;

echo "<pre>";

$name = UploadWizard::name();

echo 'Random name: ' . $name . PHP_EOL;

/* with prefix */
$name = UploadWizard::name('prefix');

echo 'With prefix: ' . $name . PHP_EOL;

/* with suffix */
$name = UploadWizard::name(suffix: 'suffix');

echo 'With suffix: ' . $name . PHP_EOL;

/* with prefix and suffix */
$name = UploadWizard::name('prefix', 'suffix');

echo 'With prefix and suffix: ' . $name . PHP_EOL;

/* with custom extension */
$name = UploadWizard::name(
    separator: '-',
    extension: 'png'
);

echo 'With custom extension: ' . $name . PHP_EOL;

/* with custom separator */
$name = UploadWizard::name('prefix', separator: '_');

echo 'With custom separator: ' . $name . PHP_EOL;

echo "</pre>";

// Output:
// 2021-09-01-13-00-00-000000.jpg
// prefix-2021-09-01-13-00-00-000000.jpg
// 2021-09-01-13-00-00-000000-suffix.jpg
// prefix-2021-09-01-13-00-00-000000-suffix.jpg
// 2021-09-01-13-00-00-000000.png
// prefix_2021-09-01-13-00-00-000000.jpg
