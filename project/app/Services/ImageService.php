<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

class ImageService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    public function upload(
        UploadedFile $file,
        string $directory = 'images',
        int $maxWidth = 1200,
        int $quality = 80
    ): string {

        // Decode image
        $image = $this->manager->decode($file);

        // Resize
        $image->scaleDown(width: $maxWidth);

        // Filename
        $filename = time() . '_' . uniqid() . '.webp';

        $path = $directory . '/' . $filename;

        // WebP encode
        $encoded = $image->encode(
            new WebpEncoder(quality: $quality)
        );

        // Save
        Storage::disk('public')->put($path, $encoded);

        return $path;
    }
}