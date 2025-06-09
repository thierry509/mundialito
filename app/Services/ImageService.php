<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Exceptions\EncoderException;

class ImageService
{
    public function store($file, string $desc, string $path = 'uploads', int $width = 300, int $height = 200): array
    {
        $manager = new ImageManager(new Driver());

        // Création de l'image et de la miniature
        $image = $manager->read($file->getRealPath());
        $thumbnail = $image->resize($width, $height);

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
            $image->save(storage_path("app/public/{$originalPath}"));
            $thumbnail->save(storage_path("app/public/{$thumbnailPath}"));
        } catch (EncoderException $e) {
            throw new \RuntimeException("Failed to save image: " . $e->getMessage());
        }

        return [
            'original' => $originalPath,
            'thumbnail' => $thumbnailPath
        ];
    }

    /**
     * Update an existing image and its thumbnail
     *
     * @param mixed $file The new image file
     * @param string $desc The new description for the image
     * @param string $currentOriginalPath Current original image path
     * @param string $currentThumbnailPath Current thumbnail path
     * @param string $path Storage path (default: 'uploads')
     * @param int $width Thumbnail width (default: 300)
     * @param int $height Thumbnail height (default: 200)
     * @return array Paths of the updated images
     * @throws \RuntimeException
     */
    public function update(
        $file,
        string $desc,
        string $currentOriginalPath,
        string $currentThumbnailPath,
        string $path = 'uploads',
        int $width = 300,
        int $height = 200
    ): array {
        // First store the new image
        $newPaths = $this->store($file, $desc, $path, $width, $height);

        try {
            // Delete the old images
            Storage::delete([
                "public/{$currentOriginalPath}",
                "public/{$currentThumbnailPath}"
            ]);
        } catch (\Exception $e) {
            // If deletion fails, try to delete the new images and rethrow the exception
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

        // Si le fichier existe déjà, ajouter un suffixe unique
        if (Storage::exists("public/{$path}/{$baseName}")) {
            $suffix = time() . '-' . random_int(1000, 9999);
            $baseName = "{$slug}-{$suffix}.{$extension}";
        }

        return $baseName;
    }

    protected function getOptimalExtension($file): string
    {
        $mime = $file->getMimeType();

        return match ($mime) {
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
            default => 'webp', // Fallback to WebP si format inconnu
        };
    }

    protected function ensureDirectoriesExist(string $path): void
    {
        $paths = [
            "public/{$path}",
            "public/{$path}/thumbnails"
        ];

        foreach ($paths as $directory) {
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory, 0755, true);
            }
        }
    }
}
