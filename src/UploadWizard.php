<?php

namespace Filewizard;

use Filewizard\Interfaces\UploadWizardInterface;

final class UploadWizard implements UploadWizardInterface
{
    public static function name(
        string $prefix = '',
        string $suffix = '',
        string $separator = '-',
        string $extension = 'jpg'
    ): string {

        if($prefix) {
            $prefix .= $separator;
        }

        if($suffix) {
            $suffix = $separator . $suffix;
        }

        return $prefix . md5(microtime()) . $suffix . '.' . $extension;
    }
}
