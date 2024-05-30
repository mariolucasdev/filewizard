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
        self::$source      = $source;
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
        string|array $source,
        string|null $destination = null,
        bool $rename = true,
    ): array {

        if(is_array($source)) {
            $files = [];

            foreach($source as $file) {
                $files[] = self::upload(
                    source: $file,
                    destination: $destination,
                    rename: $rename
                );
            }

            return $files;
        }

        self::validate(
            source: $source,
            destination: $destination
        );

        $file = self::$source . $source;

        if(!file_exists($file)) {
            throw new \Exception('File does not exist');
        }

        $mime      = mime_content_type($file);
        $extension = explode('/', $mime)[1];
        $size      = filesize($file);

        if($rename) {
            $destination = self::rename(
                destination: $destination,
                extension: $extension
            );
        }

        $destination = $destination ?? self::$destination . self::name(extension: $extension);

        copy($file, $destination);

        $name = explode('/', $destination)[count(explode('/', $destination)) - 1];

        return [
            'name'        => $name,
            'source'      => $file,
            'destination' => $destination,
            'mime'        => $mime,
            'extension'   => $extension,
            'size'        => $size,
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

        if($destination && !$create && !is_dir($destination)) {
            throw new \Exception('Destination directory does not exist');
        }

        self::$destination = $destination;
    }

    public static function validate(
        string $source,
        string|null $destination
    ): void {
        if(!self::$source) {
            if(!file_exists($source)) {
                throw new \Exception('Source file or directory does not exist');
            }
        }

        if(!self::$destination) {
            if(!file_exists($destination)) {
                throw new \Exception('Destination directory does not exist');
            }
        }
    }

    public static function rename(
        string|null $destination,
        string $extension
    ): string {
        $newName = self::name(
            extension: $extension
        );

        $destination = self::$destination . $destination;

        if(!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        return $destination .= $newName;
    }
}
