<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Exceptions\EncoderException;

class ImageService
{
    public function store(
        $file,
        string $desc,
        string $path = 'uploads',
        int $thumbnailWidth = 300,
        int $thumbnailHeight = 200,
        int $quality = 90
    ): array {
        $manager = new ImageManager(new Driver());

        // Création de l'image et de la miniature
        $image = $manager->read($file->getRealPath());
        $thumbnail = clone $image;

        // Utilisation de resize + crop si fit() ne fonctionne pas
            $thumbnail->resize($thumbnailWidth, $thumbnailHeight, function ($constraint) {
                $constraint->aspectRatio();
            })->crop($thumbnailWidth, $thumbnailHeight);

        // Gestion du nom et de l'extension
        $extension = $this->getOptimalExtension($file);
        $filename = $this->generateUniqueFilename($desc, $extension, $path);

        // Chemins de stockage
        $originalPath = "{$path}/{$filename}";
        $thumbnailPath = "{$path}/thumbnails/{$filename}";

        // Création des répertoires si nécessaire
        $this->ensureDirectoriesExist($path);

        // Sauvegarde avec gestion d'erreur
        try {
            $image->save(storage_path("app/public/{$originalPath}"), quality: $quality);
            $thumbnail->save(storage_path("app/public/{$thumbnailPath}"), quality: $quality);
        } catch (EncoderException $e) {
            throw new \RuntimeException("Failed to save image: " . $e->getMessage());
        }

        return [
            'original' => $originalPath,
            'thumbnail' => $thumbnailPath
        ];
    }

    public function update(
        $file,
        string $desc,
        string $currentOriginalPath,
        string $currentThumbnailPath,
        string $path = 'uploads',
        int $width = 300,
        int $height = 200
    ): array {
        $newPaths = $this->store($file, $desc, $path, $width, $height);

        try {
            // Delete the old images
            Storage::delete([
                "public/{$currentOriginalPath}",
                "public/{$currentThumbnailPath}"
            ]);
        } catch (\Exception $e) {
            // Rollback en cas d'échec
            Storage::delete([
                "public/{$newPaths['original']}",
                "public/{$newPaths['thumbnail']}"
            ]);
            throw new \RuntimeException("Failed to delete old images: " . $e->getMessage());
        }

        return $newPaths;
    }

    protected function generateUniqueFilename(string $description, string $extension, string $path): string
    {
        $slug = Str::slug($description);
        $baseName = "{$slug}.{$extension}";

        if (Storage::exists("public/{$path}/{$baseName}")) {
            $suffix = time() . '-' . bin2hex(random_bytes(2));
            $baseName = "{$slug}-{$suffix}.{$extension}";
        }

        return $baseName;
    }

    protected function getOptimalExtension($file): string
    {
        return match ($file->getMimeType()) {
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
            default => $file->guessExtension() ?? 'webp',
        };
    }

    protected function ensureDirectoriesExist(string $path): void
    {
        collect([
            "public/{$path}",
            "public/{$path}/thumbnails"
        ])->each(function ($directory) {
            Storage::makeDirectory($directory, 0755, true);
        });
    }
}
