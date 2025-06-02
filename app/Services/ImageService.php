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
