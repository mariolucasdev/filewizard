<?php

use Filewizard\UploadWizard;

test('should upload a file', function () {
    $wizard = new UploadWizard(
        __DIR__ . '/../../_data/',
        __DIR__ . '/../../_data/uploads/',
    );

    $file = $wizard::upload('image.png');

    expect($file)
        ->toBeArray()
        ->toHaveKey('name')
        ->toHaveKey('source')
        ->toHaveKey('destination')
        ->toHaveKey('extension')
        ->toHaveKey('size')
        ->toHaveKey('mime');

    expect($file['destination'])
        ->toBeFile();

    unlink($file['destination']);
});

test('should upload a file without setup source and destinations', function () {
    $wizard = new UploadWizard();

    $file = $wizard::upload(
        __DIR__ . '/../../_data/image.png',
        __DIR__ . '/../../_data/uploads/'
    );

    expect($file)
        ->toBeArray()
        ->toHaveKey('name')
        ->toHaveKey('source')
        ->toHaveKey('destination')
        ->toHaveKey('extension')
        ->toHaveKey('size')
        ->toHaveKey('mime');

    expect($file['destination'])
        ->toBeFile();

    unlink($file['destination']);
});
