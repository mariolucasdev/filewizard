<?php

namespace Filewizard\Interfaces;

interface UploadWizardInterface
{
    public static function name(
        string $prefix,
        string $suffix,
        string $separator,
        string $extension
    ): string;

    public static function upload(
        string $source,
        string $destination,
        bool $rename
    ): array;
}
