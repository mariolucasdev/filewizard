<?php

namespace Filewizard;

use Filewizard\Interfaces\UploadWizardInterface;

final class UploadWizard implements UploadWizardInterface
{
    private static string $source;

    private static string $destination;

    public function __construct(
        $source = '',
        $destination = ''
    ) {
        self::$source = $source;
        self::$destination = $destination;
    }

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

    public static function upload(
        string $source,
        string $destination = null,
        bool $rename = true,
    ): array {

        if(! self::$source) {
            if(!file_exists($source)) {
                throw new \Exception('Source file or directory does not exist');
            }
        }

        if(! self::$destination) {
            if(!file_exists($destination)) {
                throw new \Exception('Destination directory does not exist');
            }
        }

        $file = self::$source . $source;

        if(! file_exists($file)) {
            throw new \Exception('File does not exist');
        }

        $extension = pathinfo($file, PATHINFO_EXTENSION);

        if($rename) {
            $newName = self::name(
                extension: $extension
            );

            if(! is_dir(self::$destination . $destination)) {
                mkdir(self::$destination . $destination, 0755, true);
            }

            $destination = self::$destination . $destination . $newName;
        }

        copy($file, $destination);

        return [
            'name' => $newName,
            'source' => $file,
            'destination' => $destination,
            'extension' => $extension,
            'size' => filesize($file),
            'mime' => mime_content_type($file)
        ];
    }

    public static function source(string $source): void
    {
        if($source && !is_dir($source)) {
            throw new \Exception('Source directory does not exist');
        }

        self::$source = $source;
    }

    public static function destination(string $destination, bool $create = false): void
    {
        if($destination && $create && !is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        if($destination && ! $create && !is_dir($destination)) {
            throw new \Exception('Destination directory does not exist');
        }

        self::$destination = $destination;
    }
}
