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
    $wizard = new UploadWizard(
        destination: __DIR__ . '/../../_data/uploads/'
    );

    $file = $wizard::upload(
        __DIR__ . '/../../_data/image.png'
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

test('should upload multiple files', function () {
    $wizard = new UploadWizard(
        __DIR__ . '/../../_data/',
        __DIR__ . '/../../_data/uploads/',
    );

    $files = $wizard::upload([
        'image.png',
        'image.png',
    ]);

    expect($files)
        ->toBeArray()
        ->toHaveCount(2);

    foreach ($files as $file) {
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
    }
});
