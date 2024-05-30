<?php

use Filewizard\UploadWizard;

test('should generate a random name', function () {
    $name = UploadWizard::name();

    expect($name)
        ->toBeString()
        ->toContain('.jpg');
});

test('should generate a random name with a prefix', function () {
    $name = UploadWizard::name('prefix');

    expect($name)
        ->toBeString()
        ->toContain('prefix-')
        ->toContain('.jpg');
});

test('should generate a random name with a suffix', function () {
    $name = UploadWizard::name(suffix: 'suffix');

    expect($name)
        ->toBeString()
        ->toContain('-suffix')
        ->toContain('.jpg');
});

test('should generate a random name with a prefix and suffix', function () {
    $name = UploadWizard::name('prefix', 'suffix');

    expect($name)
        ->toBeString()
        ->toContain('prefix-')
        ->toContain('-suffix')
        ->toContain('.jpg');
});

test('should generate a random name with a custom extension', function () {
    $name = UploadWizard::name(
        separator: '-',
        extension: 'png'
    );

    expect($name)
        ->toBeString()
        ->toContain('.png');
});

test('should generate a random name with a custom separator', function () {
    $name = UploadWizard::name('prefix', separator: '_');

    expect($name)
        ->toBeString()
        ->toContain('_');
});
