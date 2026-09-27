<?php

namespace App\Support;

/**
 * Fast image helper for the public site.
 *
 * - Serves a resized .webp copy next to the original (generated once, on demand)
 * - Falls back to the original file when WebP/GD is unavailable
 * - Emits width/height so the browser reserves space (no layout shift)
 */
class Img
{
    const MAX_WIDTH = 1920;
    const QUALITY = 80;

    protected static $cache = [];

    /**
     * Public URL for an image path relative to the project root, e.g. "asset/images/slider/1.png".
     */
    public static function url($path)
    {
        return asset(static::resolve($path)['path']);
    }

    /**
     * Full <img> tag. $attrs: class, loading (lazy|eager), fetchpriority, sizes, style, etc.
     */
    public static function tag($path, $alt = '', array $attrs = [])
    {
        $img = static::resolve($path);

        $attrs = array_merge([
            'src' => asset($img['path']),
            'alt' => $alt,
            'loading' => 'lazy',
            'decoding' => 'async',
        ], $attrs);

        if ($img['width'] && !isset($attrs['width'])) {
            $attrs['width'] = $img['width'];
            $attrs['height'] = $img['height'];
        }

        $html = '<img';
        foreach ($attrs as $key => $value) {
            if ($value === null || $value === false) {
                continue;
            }
            $html .= ' ' . $key . '="' . e($value) . '"';
        }

        return $html . '>';
    }

    /**
     * @return array{path:string,width:int|null,height:int|null}
     */
    public static function resolve($path)
    {
        $path = ltrim((string) $path, '/');

        if (isset(static::$cache[$path])) {
            return static::$cache[$path];
        }

        $result = ['path' => $path, 'width' => null, 'height' => null];
        $source = base_path($path);

        if ($path === '' || !is_file($source)) {
            return static::$cache[$path] = $result;
        }

        $webp = static::webpPath($path);
        if ($webp !== null) {
            $result['path'] = $webp;
        }

        $size = @getimagesize(base_path($result['path']));
        if ($size) {
            $result['width'] = $size[0];
            $result['height'] = $size[1];
        }

        return static::$cache[$path] = $result;
    }

    /**
     * Returns the relative path of an up-to-date WebP copy, creating it if needed.
     */
    public static function webpPath($path, $force = false)
    {
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        if ($ext === 'webp') {
            return $path;
        }
        if (!in_array($ext, ['jpg', 'jpeg', 'png'], true)) {
            return null;
        }

        $source = base_path($path);
        // Keep the original extension (photo.png -> photo.png.webp) so photo.jpg and photo.png never collide.
        $targetRel = $path . '.webp';
        $target = base_path($targetRel);

        if (!$force && is_file($target) && filemtime($target) >= filemtime($source)) {
            return $targetRel;
        }

        return static::convert($source, $target) ? $targetRel : null;
    }

    protected static function convert($source, $target)
    {
        if (!function_exists('imagewebp') || !is_writable(dirname($target))) {
            return false;
        }

        try {
            $info = @getimagesize($source);
            if (!$info) {
                return false;
            }

            switch ($info[2]) {
                case IMAGETYPE_JPEG:
                    $image = @imagecreatefromjpeg($source);
                    break;
                case IMAGETYPE_PNG:
                    $image = @imagecreatefrompng($source);
                    break;
                default:
                    return false;
            }

            if (!$image) {
                return false;
            }

            if (!imageistruecolor($image)) {
                imagepalettetotruecolor($image);
            }
            imagealphablending($image, true);
            imagesavealpha($image, true);

            $width = imagesx($image);
            if ($width > static::MAX_WIDTH) {
                $scaled = imagescale($image, static::MAX_WIDTH, -1, IMG_BICUBIC);
                if ($scaled) {
                    imagedestroy($image);
                    $image = $scaled;
                    imagesavealpha($image, true);
                }
            }

            $ok = imagewebp($image, $target, static::QUALITY);
            imagedestroy($image);

            return $ok;
        } catch (\Throwable $e) {
            @unlink($target);
            return false;
        }
    }
}
